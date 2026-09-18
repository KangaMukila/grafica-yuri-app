@extends('layouts.admin')

@section('titulo', 'Configurações')

@section('conteudo')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.configuracoes.update') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-xs text-gray-500 mb-1">Nome da gráfica</label>
            <input type="text" name="grafica_nome" required value="{{ old('grafica_nome', $configuracoes['grafica_nome']) }}" class="w-full border-gray-300 rounded text-sm">
            <p class="text-xs text-gray-400 mt-1">Este nome aparece em todo o sistema e no site público.</p>
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Logotipo</label>
            @if ($configuracoes['grafica_logo'])
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($configuracoes['grafica_logo']) }}" class="h-16 mb-2">
            @endif
            <input type="file" name="logo" accept="image/*" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Telefone</label>
                <input type="text" name="grafica_telefone" value="{{ old('grafica_telefone', $configuracoes['grafica_telefone']) }}" class="w-full border-gray-300 rounded text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">E-mail</label>
                <input type="email" name="grafica_email" value="{{ old('grafica_email', $configuracoes['grafica_email']) }}" class="w-full border-gray-300 rounded text-sm">
            </div>
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Endereço</label>
            <input type="text" name="grafica_endereco" value="{{ old('grafica_endereco', $configuracoes['grafica_endereco']) }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div class="border-t pt-4">
            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="site_publico_ativo" value="1" @checked($configuracoes['site_publico_ativo'] === '1')>
                Ativar site público (catálogo + pedidos online)
            </label>
            <p class="text-xs text-gray-400 mt-1">
                Quando ativo, os itens marcados como "Disponível no site" aparecem em <code>/</code> para o cliente pedir serviços.
            </p>
        </div>

        <button class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Guardar configurações</button>
    </form>
</div>
@endsection
