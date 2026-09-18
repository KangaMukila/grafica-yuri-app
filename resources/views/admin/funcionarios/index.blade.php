@extends('layouts.admin')

@section('titulo', 'Funcionários')

@section('conteudo')
<div class="flex items-center justify-end mb-4">
    @can('funcionarios.gerir')
        <a href="{{ route('admin.funcionarios.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">+ Novo funcionário</a>
    @endcan
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Cargo</th>
                <th class="px-4 py-2">Nível de acesso</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($funcionarios as $funcionario)
                <tr>
                    <td class="px-4 py-2">
                        <p class="font-medium">{{ $funcionario->user->name }}</p>
                        <p class="text-xs text-gray-400">{{ $funcionario->user->email }}</p>
                    </td>
                    <td class="px-4 py-2">{{ $funcionario->cargo }}</td>
                    <td class="px-4 py-2">{{ $funcionario->user->getRoleNames()->implode(', ') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-0.5 rounded text-xs {{ $funcionario->user->ativo ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $funcionario->user->ativo ? 'Ativo' : 'Inativo' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-right space-x-2">
                        @can('funcionarios.gerir')
                            <a href="{{ route('admin.funcionarios.edit', $funcionario) }}" class="text-blue-600 text-xs hover:underline">Editar</a>
                            <form method="POST" action="{{ route('admin.funcionarios.destroy', $funcionario) }}" class="inline" onsubmit="return confirm('Desativar este funcionário?');">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-xs hover:underline">Desativar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Nenhum funcionário cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $funcionarios->links() }}</div>
@endsection
