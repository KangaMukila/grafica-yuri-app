@extends('layouts.admin')

@section('titulo', 'Venda ' . $venda->numero)

@section('conteudo')
<div class="grid md:grid-cols-3 gap-6">
    <div class="md:col-span-2 bg-white rounded-lg shadow p-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold">Itens</h2>
            <div class="flex items-center gap-2">
            <a href="{{ route('admin.vendas.pdf', $venda) }}" class="public-outline-button text-xs" aria-label="Baixar venda em PDF"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"/></svg> PDF</a>
            <span class="text-xs px-2 py-1 rounded
                {{ $venda->status === 'pago' ? 'bg-green-100 text-green-700' : '' }}
                {{ $venda->status === 'pendente' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $venda->status === 'cancelado' ? 'bg-red-100 text-red-700' : '' }}">
                {{ ucfirst($venda->status) }}
            </span>
            </div>
        </div>

        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b">
                <tr>
                    <th class="py-2">Serviço</th>
                    <th class="py-2">Qtd.</th>
                    <th class="py-2">Preço</th>
                    <th class="py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($venda->items as $linha)
                    <tr>
                        <td class="py-2">{{ $linha->item_nome }}</td>
                        <td class="py-2">{{ $linha->quantidade }}</td>
                        <td class="py-2">{{ number_format($linha->preco_unitario, 2, ',', '.') }} Kz</td>
                        <td class="py-2">{{ number_format($linha->subtotal, 2, ',', '.') }} Kz</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-4 space-y-1">
            <p class="text-sm text-gray-500">Desconto: {{ number_format($venda->desconto, 2, ',', '.') }} Kz</p>
            <p class="text-lg font-semibold">Total: {{ number_format($venda->total, 2, ',', '.') }} Kz</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4 space-y-3">
        <div>
            <p class="text-xs text-gray-500">Cliente</p>
            <p class="text-sm font-medium">{{ $venda->cliente?->name ?? $venda->cliente_nome ?? '—' }}</p>
            <p class="text-xs text-gray-400">{{ $venda->cliente_telefone }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-500">Vendedor</p>
            <p class="text-sm font-medium">{{ $venda->vendedor?->name ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-500">Forma de pagamento</p>
            <p class="text-sm font-medium">{{ ucfirst($venda->forma_pagamento) }}</p>
        </div>
        @if ($venda->observacoes)
            <div>
                <p class="text-xs text-gray-500">Observações</p>
                <p class="text-sm">{{ $venda->observacoes }}</p>
            </div>
        @endif

        @if ($venda->status === 'pendente')
            <form method="POST" action="{{ route('admin.vendas.marcar-paga', $venda) }}" class="pt-2 border-t space-y-2">
                @csrf @method('PATCH')
                <label class="block text-xs text-gray-500">Valor recebido (Kz)</label>
                <input type="number" step="0.01" name="total_pago" value="{{ $venda->total }}" class="w-full border-gray-300 rounded text-sm">
                <button class="w-full bg-green-600 text-white rounded py-2 text-sm hover:bg-green-700">Marcar como paga</button>
            </form>

            @can('vendas.cancelar')
                <form method="POST" action="{{ route('admin.vendas.cancelar', $venda) }}" onsubmit="return confirm('Cancelar esta venda?');">
                    @csrf @method('PATCH')
                    <button class="w-full bg-red-50 text-red-600 rounded py-2 text-sm hover:bg-red-100">Cancelar venda</button>
                </form>
            @endcan
        @endif
    </div>
</div>
@endsection
