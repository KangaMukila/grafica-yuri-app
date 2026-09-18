@extends('layouts.admin')

@section('titulo', 'Vendas')

@section('conteudo')
<div class="flex items-center justify-between mb-4">
    <form method="GET" class="flex gap-2">
        <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Número da venda..." class="border-gray-300 rounded text-sm">
        <select name="status" class="border-gray-300 rounded text-sm">
            <option value="">Todos os status</option>
            <option value="pendente" @selected(request('status') === 'pendente')>Pendente</option>
            <option value="pago" @selected(request('status') === 'pago')>Pago</option>
            <option value="entregue" @selected(request('status') === 'entregue')>Entregue</option>
            <option value="cancelado" @selected(request('status') === 'cancelado')>Cancelado</option>
        </select>
        <button class="bg-gray-200 rounded px-3 text-sm">Filtrar</button>
    </form>

    @can('vendas.criar')
        <a href="{{ route('admin.vendas.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">+ Nova venda</a>
    @endcan
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-2">Número</th>
                <th class="px-4 py-2">Cliente</th>
                <th class="px-4 py-2">Vendedor</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Data</th>
                <th class="px-4 py-2 text-right">Documento</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($vendas as $venda)
                <tr>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.vendas.show', $venda) }}" class="text-blue-600 hover:underline">{{ $venda->numero }}</a>
                    </td>
                    <td class="px-4 py-2">{{ $venda->cliente?->name ?? $venda->cliente_nome ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $venda->vendedor?->name ?? '—' }}</td>
                    <td class="px-4 py-2">{{ number_format($venda->total, 2, ',', '.') }} Kz</td>
                    <td class="px-4 py-2">{{ ucfirst($venda->status) }}</td>
                    <td class="px-4 py-2">{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 text-right"><a href="{{ route('admin.vendas.pdf', $venda) }}" class="text-blue-600 hover:underline" aria-label="Baixar {{ $venda->numero }} em PDF">Baixar PDF</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-400">Nenhuma venda encontrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $vendas->links() }}</div>
@endsection
