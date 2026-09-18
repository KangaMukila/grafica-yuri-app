@extends('layouts.admin')

@section('titulo', 'Novo funcionário')

@section('conteudo')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.funcionarios.store') }}" class="grid md:grid-cols-2 gap-4">
        @csrf

        <div class="md:col-span-2">
            <label class="block text-xs text-gray-500 mb-1">Nome completo</label>
            <input type="text" name="name" required value="{{ old('name') }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">E-mail (login)</label>
            <input type="email" name="email" required value="{{ old('email') }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Telefone</label>
            <input type="text" name="telefone" value="{{ old('telefone') }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Senha</label>
            <input type="password" name="password" required class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Confirmar senha</label>
            <input type="password" name="password_confirmation" required class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Nível de acesso</label>
            <select name="role" required class="w-full border-gray-300 rounded text-sm">
                <option value="funcionario">Funcionário</option>
                <option value="gerente">Gerente</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Cargo</label>
            <input type="text" name="cargo" required placeholder="Ex: Designer, Operador" value="{{ old('cargo') }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Salário (Kz)</label>
            <input type="number" step="0.01" name="salario" value="{{ old('salario') }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Data de admissão</label>
            <input type="date" name="data_admissao" value="{{ old('data_admissao') }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Bilhete de identidade</label>
            <input type="text" name="bilhete_identidade" value="{{ old('bilhete_identidade') }}" class="w-full border-gray-300 rounded text-sm">
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs text-gray-500 mb-1">Observações</label>
            <textarea name="observacoes" rows="2" class="w-full border-gray-300 rounded text-sm">{{ old('observacoes') }}</textarea>
        </div>

        <div class="md:col-span-2 flex gap-2 mt-2">
            <button class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Guardar</button>
            <a href="{{ route('admin.funcionarios.index') }}" class="px-4 py-2 rounded text-sm border">Cancelar</a>
        </div>
    </form>
</div>
@endsection
