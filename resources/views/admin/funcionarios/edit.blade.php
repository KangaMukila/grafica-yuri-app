@extends('layouts.admin')

@section('titulo', 'Editar funcionário')

@section('conteudo')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.funcionarios.update', $funcionario) }}" class="grid md:grid-cols-2 gap-4">
        @csrf @method('PUT')

        <div class="md:col-span-2">
            <label class="block text-xs text-gray-500 mb-1">Nome completo</label>
            <input type="text" name="name" required value="{{ old('name', $funcionario->user->name) }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Telefone</label>
            <input type="text" name="telefone" value="{{ old('telefone', $funcionario->user->telefone) }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Nível de acesso</label>
            <select name="role" required class="w-full border-gray-300 rounded text-sm">
                @foreach (['funcionario' => 'Funcionário', 'gerente' => 'Gerente', 'admin' => 'Administrador'] as $valor => $rotulo)
                    <option value="{{ $valor }}" @selected($funcionario->user->hasRole($valor))>{{ $rotulo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Cargo</label>
            <input type="text" name="cargo" required value="{{ old('cargo', $funcionario->cargo) }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Salário (Kz)</label>
            <input type="number" step="0.01" name="salario" value="{{ old('salario', $funcionario->salario) }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Data de admissão</label>
            <input type="date" name="data_admissao" value="{{ old('data_admissao', optional($funcionario->data_admissao)->format('Y-m-d')) }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs text-gray-500 mb-1">Observações</label>
            <textarea name="observacoes" rows="2" class="w-full border-gray-300 rounded text-sm">{{ old('observacoes', $funcionario->observacoes) }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="inline-flex items-center gap-1 text-sm">
                <input type="checkbox" name="ativo" value="1" @checked(old('ativo', $funcionario->user->ativo))> Conta ativa
            </label>
        </div>

        <div class="md:col-span-2 flex gap-2 mt-2">
            <button class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Guardar</button>
            <a href="{{ route('admin.funcionarios.index') }}" class="px-4 py-2 rounded text-sm border">Cancelar</a>
        </div>
    </form>
</div>
@endsection
