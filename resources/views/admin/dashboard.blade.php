@extends('layouts.admin')

@section('titulo', 'Painel')

@section('conteudo')
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-xs text-gray-500">Vendas hoje</p>
        <p class="text-2xl font-bold">{{ $indicadores['vendas_hoje'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-xs text-gray-500">Total vendido hoje</p>
        <p class="text-2xl font-bold">{{ number_format($indicadores['total_vendas_hoje'], 2, ',', '.') }} Kz</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-xs text-gray-500">Vendas pendentes</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $indicadores['vendas_pendentes'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-xs text-gray-500">Pedidos online novos</p>
        <p class="text-2xl font-bold text-blue-600">{{ $indicadores['pedidos_online_novos'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-xs text-gray-500">Materiais em estoque baixo</p>
        <p class="text-2xl font-bold text-red-600">{{ $indicadores['itens_estoque_baixo'] }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-4 py-3 border-b flex items-center justify-between">
        <h2 class="font-semibold">Últimas vendas</h2>
        @can('vendas.criar')
            <a href="{{ route('admin.vendas.create') }}" class="text-sm bg-gray-900 text-white px-3 py-1.5 rounded hover:bg-gray-700">Nova venda</a>
        @endcan
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-2">Número</th>
                <th class="px-4 py-2">Vendedor</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Data</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($ultimasVendas as $venda)
                <tr>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.vendas.show', $venda) }}" class="text-blue-600 hover:underline">{{ $venda->numero }}</a>
                    </td>
                    <td class="px-4 py-2">{{ $venda->vendedor?->name ?? '—' }}</td>
                    <td class="px-4 py-2">{{ number_format($venda->total, 2, ',', '.') }} Kz</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-0.5 rounded text-xs
                            {{ $venda->status === 'pago' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $venda->status === 'pendente' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $venda->status === 'cancelado' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($venda->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Ainda não há vendas registadas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
