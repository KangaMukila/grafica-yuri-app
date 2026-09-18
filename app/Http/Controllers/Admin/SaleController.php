<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Sale;
use App\Models\StockMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:vendas.ver')->only(['index', 'show', 'pdf']);
        $this->middleware('permission:vendas.criar')->only(['create', 'store']);
        $this->middleware('permission:vendas.editar')->only(['edit', 'update']);
        $this->middleware('permission:vendas.cancelar')->only(['cancelar']);
    }

    public function index(Request $request)
    {
        $vendas = Sale::with(['vendedor', 'cliente'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('busca'), fn ($q) => $q->where('numero', 'like', '%' . $request->busca . '%'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.vendas.index', compact('vendas'));
    }

    public function create()
    {
        $servicos = Item::servicos()->ativos()->orderBy('nome')->get();

        return view('admin.vendas.create', compact('servicos'));
    }

    /**
     * Regista uma nova venda com várias linhas de itens (POS simples).
     * Espera: cliente_nome, cliente_telefone, forma_pagamento,
     *         itens[] = [{item_id, quantidade, detalhes}]
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'cliente_id' => 'nullable|exists:users,id',
            'cliente_nome' => 'nullable|string|max:255',
            'cliente_telefone' => 'nullable|string|max:50',
            'forma_pagamento' => 'required|in:dinheiro,transferencia,multicaixa',
            'desconto' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|string',
            'itens' => 'required|array|min:1',
            'itens.*.item_id' => 'required|exists:items,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.detalhes' => 'nullable|string',
        ]);

        $venda = DB::transaction(function () use ($dados) {
            $venda = Sale::create([
                'numero' => Sale::gerarNumero(),
                'vendedor_id' => Auth::id(),
                'cliente_id' => $dados['cliente_id'] ?? null,
                'cliente_nome' => $dados['cliente_nome'] ?? null,
                'cliente_telefone' => $dados['cliente_telefone'] ?? null,
                'forma_pagamento' => $dados['forma_pagamento'],
                'desconto' => $dados['desconto'] ?? 0,
                'observacoes' => $dados['observacoes'] ?? null,
                'origem' => 'balcao',
                'status' => Sale::STATUS_PENDENTE,
            ]);

            foreach ($dados['itens'] as $linha) {
                $item = Item::findOrFail($linha['item_id']);
                $preco = (float) $item->preco_venda;
                $quantidade = (int) $linha['quantidade'];

                $venda->items()->create([
                    'item_id' => $item->id,
                    'item_nome' => $item->nome,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $preco,
                    'subtotal' => $preco * $quantidade,
                    'detalhes' => $linha['detalhes'] ?? null,
                ]);
            }

            $venda->recalcularTotal();

            return $venda;
        });

        return redirect()
            ->route('admin.vendas.show', $venda)
            ->with('sucesso', "Venda {$venda->numero} registada com sucesso.");
    }

    public function show(Sale $venda)
    {
        $venda->load(['items.item', 'vendedor', 'cliente']);

        return view('admin.vendas.show', compact('venda'));
    }

    public function pdf(Sale $venda)
    {
        $venda->load(['items.item', 'vendedor', 'cliente']);

        return Pdf::loadView('admin.vendas.pdf', compact('venda'))
            ->setPaper('a4', 'portrait')
            ->download('venda-' . $venda->numero . '.pdf');
    }

    /**
     * Marca a venda como paga e regista o valor efetivamente pago.
     */
    public function marcarPaga(Request $request, Sale $venda)
    {
        $dados = $request->validate(['total_pago' => 'required|numeric|min:0']);

        $venda->update([
            'total_pago' => $dados['total_pago'],
            'status' => Sale::STATUS_PAGO,
        ]);

        return back()->with('sucesso', 'Venda marcada como paga.');
    }

    public function cancelar(Sale $venda)
    {
        $venda->update(['status' => Sale::STATUS_CANCELADO]);

        return back()->with('sucesso', 'Venda cancelada.');
    }
}
