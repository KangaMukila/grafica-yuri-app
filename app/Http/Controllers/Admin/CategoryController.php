<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categorias.ver')->only(['index']);
        $this->middleware('permission:categorias.gerir')->except(['index']);
    }

    public function index()
    {
        $categorias = Category::withCount('items')->orderBy('grupo')->orderBy('nome')->get();

        return view('admin.categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'grupo' => 'required|in:custo,servico,reprografia,timbragem',
            'descricao' => 'nullable|string',
        ]);

        $dados['slug'] = Str::slug($dados['nome']) . '-' . Str::random(4);
        $dados['ativo'] = true;

        Category::create($dados);

        return back()->with('sucesso', 'Categoria criada com sucesso.');
    }

    public function update(Request $request, Category $categoria)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'grupo' => 'required|in:custo,servico,reprografia,timbragem',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $categoria->update($dados);

        return back()->with('sucesso', 'Categoria atualizada.');
    }

    public function destroy(Category $categoria)
    {
        if ($categoria->items()->exists()) {
            return back()->with('erro', 'Não é possível remover: existem itens associados a esta categoria.');
        }

        $categoria->delete();

        return back()->with('sucesso', 'Categoria removida.');
    }
}
