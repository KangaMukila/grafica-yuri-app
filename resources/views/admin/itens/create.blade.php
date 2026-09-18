@extends('layouts.admin')

@section('titulo', 'Novo item')

@section('conteudo')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <form method="POST" action="{{ route('admin.itens.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.itens._form')

        <div class="mt-6 flex gap-2">
            <button class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Guardar</button>
            <a href="{{ route('admin.itens.index') }}" class="px-4 py-2 rounded text-sm border">Cancelar</a>
        </div>
    </form>
</div>
@endsection
