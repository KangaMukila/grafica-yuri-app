@extends('layouts.admin')

@section('titulo', 'Pedidos Online')

@section('conteudo')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-2">Cliente</th>
                <th class="px-4 py-2">Serviço</th>
                <th class="px-4 py-2">Descrição</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Data</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($pedidos as $pedido)
                <tr>
                    <td class="px-4 py-2">
                        <p class="font-medium">{{ $pedido->cliente_nome }}</p>
                        <p class="text-xs text-gray-400">{{ $pedido->cliente_telefone }}</p>
                    </td>
                    <td class="px-4 py-2">{{ $pedido->item->nome }}</td>
                    <td class="px-4 py-2 max-w-xs truncate">{{ $pedido->descricao }}</td>
                    <td class="px-4 py-2">
                        @can('pedidos.gerir')
                            <form method="POST" action="{{ route('admin.pedidos.status', $pedido) }}">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded text-xs">
                                    @foreach (['novo' => 'Novo', 'em_analise' => 'Em análise', 'aprovado' => 'Aprovado', 'rejeitado' => 'Rejeitado', 'convertido' => 'Convertido'] as $valor => $rotulo)
                                        <option value="{{ $valor }}" @selected($pedido->status === $valor)>{{ $rotulo }}</option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}
                        @endcan
                    </td>
                    <td class="px-4 py-2">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Ainda não há pedidos online.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $pedidos->links() }}</div>
@endsection
