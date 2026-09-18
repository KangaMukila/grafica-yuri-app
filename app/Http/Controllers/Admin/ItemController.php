<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:itens.ver')->only(['index', 'show', 'pdfLista', 'pdf']);
        $this->middleware('permission:itens.gerir')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $itens = Item::with(['category', 'images'])
            ->when($request->filled('grupo'), fn ($q) => $q->whereHas('category', fn ($c) => $c->where('grupo', $request->grupo)))
            ->when($request->filled('busca'), fn ($q) => $q->where('nome', 'like', '%' . $request->busca . '%'))
            ->orderBy('nome')
            ->paginate(20)
            ->withQueryString();

        $categorias = Category::ativas()->orderBy('nome')->get();

        return view('admin.itens.index', compact('itens', 'categorias'));
    }

    public function pdfLista(Request $request)
    {
        $itens = $this->consultaItens($request)->get();

        return Pdf::loadView('admin.itens.pdf', compact('itens'))
            ->setPaper('a4', 'landscape')
            ->download('servicos-e-materiais-' . now()->format('Y-m-d') . '.pdf');
    }

    public function pdf(Item $item)
    {
        $item->load(['category', 'images']);

        return Pdf::loadView('admin.itens.item-pdf', compact('item'))
            ->setPaper('a4', 'portrait')
            ->download('item-' . $item->id . '.pdf');
    }

    public function create()
    {
        $categorias = Category::ativas()->orderBy('grupo')->get();

        return view('admin.itens.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $dados = $this->validarDados($request);

        $item = Item::create($dados);

        $this->guardarFotos($request, $item);

        return redirect()
            ->route('admin.itens.index')
            ->with('sucesso', 'Item criado com sucesso.');
    }

    public function edit(Item $item)
    {
        $item->load('images');
        $categorias = Category::ativas()->orderBy('grupo')->get();

        return view('admin.itens.edit', compact('item', 'categorias'));
    }

    public function update(Request $request, Item $item)
    {
        $dados = $this->validarDados($request, $item->id);

        $item->update($dados);

        $this->guardarFotos($request, $item);

        // Remover fotos marcadas para exclusão (checkboxes "remover_foto[]")
        if ($request->filled('remover_foto')) {
            $fotos = ItemImage::whereIn('id', $request->remover_foto)
                ->where('imageable_id', $item->id)
                ->where('imageable_type', Item::class)
                ->get();

            foreach ($fotos as $foto) {
                Storage::disk('public')->delete($foto->caminho);
                $foto->delete();
            }
        }

        return redirect()
            ->route('admin.itens.index')
            ->with('sucesso', 'Item atualizado com sucesso.');
    }

    public function destroy(Item $item)
    {
        foreach ($item->images as $foto) {
            Storage::disk('public')->delete($foto->caminho);
        }
        $item->delete();

        return redirect()
            ->route('admin.itens.index')
            ->with('sucesso', 'Item removido.');
    }

    private function validarDados(Request $request, ?int $itemId = null): array
    {
        return $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:custo,servico',
            'descricao' => 'nullable|string',
            'preco_venda' => 'nullable|numeric|min:0',
            'preco_custo' => 'nullable|numeric|min:0',
            'unidade' => 'required|string|max:50',
            'estoque_atual' => 'nullable|integer|min:0',
            'estoque_minimo' => 'nullable|integer|min:0',
            'disponivel_online' => 'boolean',
            'ativo' => 'boolean',
            // Permite enviar VÁRIAS fotos de uma vez: input name="fotos[]" multiple
            'fotos.*' => 'nullable|image|max:4096',
        ]);
    }

    private function consultaItens(Request $request)
    {
        return Item::with(['category', 'images'])
            ->when($request->filled('grupo'), fn ($q) => $q->whereHas('category', fn ($c) => $c->where('grupo', $request->grupo)))
            ->when($request->filled('busca'), fn ($q) => $q->where('nome', 'like', '%' . $request->busca . '%'))
            ->orderBy('nome');
    }

    /**
     * Guarda uma ou mais fotos enviadas para o item (input múltiplo "fotos[]").
     */
    private function guardarFotos(Request $request, Item $item): void
    {
        if (! $request->hasFile('fotos')) {
            return;
        }

        $ordemAtual = $item->images()->max('ordem') ?? 0;
        $temPrincipal = $item->images()->where('principal', true)->exists();

        foreach ($request->file('fotos') as $foto) {
            $caminho = $foto->store('itens', 'public');

            $item->images()->create([
                'caminho' => $caminho,
                'principal' => ! $temPrincipal, // primeira foto enviada vira capa, se ainda não houver
                'ordem' => ++$ordemAtual,
            ]);

            $temPrincipal = true;
        }
    }
}
