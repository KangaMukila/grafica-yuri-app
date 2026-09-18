<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use App\Models\ServiceRequest as ServiceRequestModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $hoje = now()->toDateString();

        $indicadores = [
            'vendas_hoje' => Sale::whereDate('created_at', $hoje)->count(),
            'total_vendas_hoje' => Sale::whereDate('created_at', $hoje)->where('status', '!=', Sale::STATUS_CANCELADO)->sum('total'),
            'vendas_pendentes' => Sale::where('status', Sale::STATUS_PENDENTE)->count(),
            'pedidos_online_novos' => ServiceRequestModel::where('status', ServiceRequestModel::STATUS_NOVO)->count(),
            'itens_estoque_baixo' => Item::materiais()->ativos()->whereColumn('estoque_atual', '<=', 'estoque_minimo')->count(),
        ];

        $ultimasVendas = Sale::with('vendedor')->latest()->take(8)->get();

        return view('admin.dashboard', compact('indicadores', 'ultimasVendas'));
    }
}
