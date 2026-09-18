<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest as ServiceRequestModel;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pedidos.ver')->only(['index', 'show']);
        $this->middleware('permission:pedidos.gerir')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $pedidos = ServiceRequestModel::with(['item', 'cliente'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(20);

        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function atualizarStatus(Request $request, ServiceRequestModel $pedido)
    {
        $dados = $request->validate([
            'status' => 'required|in:novo,em_analise,aprovado,rejeitado,convertido',
        ]);

        $pedido->update($dados);

        return back()->with('sucesso', 'Estado do pedido atualizado.');
    }
}
