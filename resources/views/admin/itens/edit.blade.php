@extends('layouts.admin')

@section('titulo', 'Editar item')

@section('conteudo')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <form method="POST" action="{{ route('admin.itens.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.itens._form')

        <div class="mt-6 flex gap-2 justify-between">
            <div class="flex gap-2">
                <button class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Guardar</button>
                <a href="{{ route('admin.itens.index') }}" class="px-4 py-2 rounded text-sm border">Cancelar</a>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.itens.destroy', $item) }}" class="mt-4" onsubmit="return confirm('Remover este item definitivamente?');">
        @csrf @method('DELETE')
        <button class="text-red-600 text-xs hover:underline">Remover este item</button>
    </form>
</div>
@endsection
