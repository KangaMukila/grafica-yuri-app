@extends('layouts.admin')

@section('titulo', 'Categorias')

@section('conteudo')
<div class="grid md:grid-cols-3 gap-6">

    <div class="md:col-span-2 bg-white rounded-lg shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500">
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Grupo</th>
                    <th class="px-4 py-2">Itens</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($categorias as $categoria)
                    <tr>
                        <form method="POST" action="{{ route('admin.categorias.update', $categoria) }}">
                            @csrf @method('PUT')
                            <td class="px-4 py-2">
                                <input type="text" name="nome" value="{{ $categoria->nome }}" class="w-full border-gray-300 rounded text-sm">
                            </td>
                            <td class="px-4 py-2">
                                <select name="grupo" class="border-gray-300 rounded text-sm">
                                    @foreach (['custo' => 'Custo da Gráfica', 'servico' => 'Serviços', 'reprografia' => 'Reprografia', 'timbragem' => 'Timbragem'] as $valor => $rotulo)
                                        <option value="{{ $valor }}" @selected($categoria->grupo === $valor)>{{ $rotulo }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-2 text-gray-500">{{ $categoria->items_count }}</td>
                            <td class="px-4 py-2">
                                <label class="inline-flex items-center gap-1 text-xs">
                                    <input type="checkbox" name="ativo" value="1" @checked($categoria->ativo)> Ativa
                                </label>
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <button class="text-blue-600 hover:underline text-xs">Guardar</button>
                        </form>
                        <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}" class="inline" onsubmit="return confirm('Remover esta categoria?');">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline text-xs">Remover</button>
                        </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-4 h-fit">
        <h2 class="font-semibold mb-3">Nova categoria</h2>
        <form method="POST" action="{{ route('admin.categorias.store') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs text-gray-500 mb-1">Nome</label>
                <input type="text" name="nome" required class="w-full border-gray-300 rounded text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Grupo</label>
                <select name="grupo" required class="w-full border-gray-300 rounded text-sm">
                    <option value="custo">Custo da Gráfica</option>
                    <option value="servico">Serviços Prestados</option>
                    <option value="reprografia">Reprografia</option>
                    <option value="timbragem">Timbragem</option>
                </select>
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Descrição (opcional)</label>
                <textarea name="descricao" class="w-full border-gray-300 rounded text-sm" rows="2"></textarea>
            </div>
            <button class="w-full bg-gray-900 text-white rounded py-2 text-sm hover:bg-gray-700">Criar categoria</button>
        </form>
    </div>
</div>
@endsection
