<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\ServiceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:relatorios.ver');
    }

    public function index(Request $request)
    {
        $dados = $this->dados($request);

        return view('admin.relatorios.index', $dados);
    }

    public function pdf(Request $request)
    {
        $dados = $this->dados($request);

        return Pdf::loadView('admin.relatorios.pdf', $dados)
            ->setPaper('a4', 'portrait')
            ->download('relatorio-grafica-' . $dados['inicio']->format('Y-m-d') . '-a-' . $dados['fim']->format('Y-m-d') . '.pdf');
    }

    private function dados(Request $request): array
    {
        $request->validate([
            'inicio' => ['nullable', 'date'],
            'fim' => ['nullable', 'date'],
        ]);

        $fim = Carbon::parse($request->input('fim', now()->toDateString()))->endOfDay();
        $inicio = Carbon::parse($request->input('inicio', $fim->copy()->subDays(29)->toDateString()))->startOfDay();

        if ($inicio->gt($fim)) {
            [$inicio, $fim] = [$fim->copy()->startOfDay(), $inicio->copy()->endOfDay()];
        }

        $vendas = Sale::whereBetween('created_at', [$inicio, $fim]);
        $vendasLista = (clone $vendas)->with(['vendedor:id,name', 'cliente:id,name', 'items:item_id,sale_id,item_nome,quantidade,preco_unitario,subtotal,detalhes'])->latest()->get();
        $vendasValidas = (clone $vendas)->where('status', '!=', Sale::STATUS_CANCELADO);
        $total = (float) (clone $vendasValidas)->sum('total');
        $quantidadeVendas = (clone $vendasValidas)->count();

        $topServicos = SaleItem::query()
            ->select('sale_items.item_nome', DB::raw('SUM(sale_items.quantidade) as quantidade'), DB::raw('SUM(sale_items.subtotal) as total'))
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->whereBetween('sales.created_at', [$inicio, $fim])
            ->where('sales.status', '!=', Sale::STATUS_CANCELADO)
            ->groupBy('sale_items.item_nome')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $vendasPorStatus = (clone $vendas)->select('status', DB::raw('COUNT(*) as quantidade'))
            ->groupBy('status')->pluck('quantidade', 'status');

        $pedidos = ServiceRequest::whereBetween('created_at', [$inicio, $fim]);
        $pedidosPorStatus = (clone $pedidos)->select('status', DB::raw('COUNT(*) as quantidade'))
            ->groupBy('status')->pluck('quantidade', 'status');

        $despesas = Expense::whereBetween('data', [$inicio->toDateString(), $fim->toDateString()]);
        $totalDespesas = (float) $despesas->sum('valor');
        $despesasPorCategoria = (clone $despesas)
            ->select('categoria', DB::raw('SUM(valor) as total'))
            ->groupBy('categoria')
            ->get()
            ->mapWithKeys(fn ($gasto) => [$gasto->categoria => (float) $gasto->total])
            ->all();

        return [
            'inicio' => $inicio,
            'fim' => $fim,
            'indicadores' => [
                'faturamento' => $total,
                'despesas' => $totalDespesas,
                'liquido' => $total - $totalDespesas,
                'vendas' => $quantidadeVendas,
                'ticket_medio' => $quantidadeVendas > 0 ? $total / $quantidadeVendas : 0,
                'vendas_pagas' => (clone $vendas)->where('status', Sale::STATUS_PAGO)->count(),
                'vendas_pendentes' => (clone $vendas)->where('status', Sale::STATUS_PENDENTE)->count(),
                'pedidos' => (clone $pedidos)->count(),
                'itens_estoque_baixo' => Item::materiais()->ativos()->whereColumn('estoque_atual', '<=', 'estoque_minimo')->count(),
            ],
            'topServicos' => $topServicos,
            'vendasLista' => $vendasLista,
            'servicos' => Item::servicos()->ativos()->orderBy('nome')->get(['id', 'nome', 'descricao', 'preco_venda', 'unidade']),
            'materiais' => Item::materiais()->ativos()->orderBy('nome')->get(['id', 'nome', 'descricao', 'preco_venda', 'unidade', 'estoque_atual', 'estoque_minimo']),
            'vendasPorStatus' => $vendasPorStatus,
            'pedidosPorStatus' => $pedidosPorStatus,
            'despesasPorCategoria' => $despesasPorCategoria,
            'despesasRecentes' => $despesas->with('user')->latest('data')->limit(8)->get(),
            'estoqueCritico' => Item::materiais()->ativos()->whereColumn('estoque_atual', '<=', 'estoque_minimo')->orderBy('estoque_atual')->limit(10)->get(),
        ];
    }
}