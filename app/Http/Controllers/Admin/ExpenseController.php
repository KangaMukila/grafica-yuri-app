<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:gastos.ver')->only(['index', 'pdf']);
        $this->middleware('permission:gastos.gerir')->only(['create', 'store']);
    }

    public function index()
    {
        $gastos = Expense::with('user')->latest('data')->latest()->paginate(20);

        return view('admin.gastos.index', compact('gastos'));
    }

    public function pdf()
    {
        $gastos = Expense::with('user')->latest('data')->latest()->get();

        return Pdf::loadView('admin.gastos.pdf', compact('gastos'))
            ->setPaper('a4', 'portrait')
            ->download('gastos-grafica-'.now()->format('Y-m-d').'.pdf');
    }

    public function create()
    {
        return view('admin.gastos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'categoria' => 'required|in:taxi,alimentacao,outros',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'data' => 'required|date',
        ]);

        Expense::create([
            'user_id' => Auth::id(),
            'categoria' => $dados['categoria'],
            'descricao' => $dados['descricao'],
            'valor' => $dados['valor'],
            'data' => $dados['data'],
        ]);

        return redirect()->route('admin.gastos.index')->with('sucesso', 'Gasto registado com sucesso.');
    }
}
