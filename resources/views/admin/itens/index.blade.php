@extends('layouts.admin')

@section('titulo', 'Serviços & Materiais')

@section('conteudo')
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <form method="GET" class="flex min-w-0 flex-col gap-2 sm:flex-row">
        <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Pesquisar..." class="w-full min-w-0 rounded border-gray-300 text-sm sm:w-auto">
        <select name="grupo" class="w-full rounded border-gray-300 text-sm sm:w-auto">
            <option value="">Todos os grupos</option>
            <option value="custo" @selected(request('grupo') === 'custo')>Custo da Gráfica</option>
            <option value="servico" @selected(request('grupo') === 'servico')>Serviços Prestados</option>
            <option value="reprografia" @selected(request('grupo') === 'reprografia')>Reprografia</option>
            <option value="timbragem" @selected(request('grupo') === 'timbragem')>Timbragem</option>
        </select>
        <button class="w-full rounded bg-gray-200 px-3 py-2 text-sm sm:w-auto">Filtrar</button>
    </form>

    <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
        @can('itens.ver')
            <a href="{{ route('admin.itens.pdf', request()->query()) }}" class="public-outline-button justify-center"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"/></svg> Baixar lista PDF</a>
        @endcan
        @can('itens.gerir')
            <a href="{{ route('admin.itens.create') }}" class="w-full rounded bg-gray-900 px-4 py-2 text-center text-sm text-white hover:bg-gray-700 sm:w-auto sm:shrink-0">+ Novo item</a>
        @endcan
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse ($itens as $item)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="aspect-square bg-gray-100 flex items-center justify-center">
                @if ($foto = $item->imagemPrincipal())
                    <img src="{{ $foto->url }}" alt="{{ $item->nome }}" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-300 text-xs">Sem foto</span>
                @endif
            </div>
            <div class="p-3">
                <p class="text-xs text-gray-400">{{ $item->category->nome }}</p>
                <p class="font-medium text-sm truncate">{{ $item->nome }}</p>
                <p class="text-sm text-gray-600 mt-1">
                    @if ($item->tipo === 'servico')
                        {{ number_format($item->preco_venda ?? 0, 2, ',', '.') }} Kz
                    @else
                        Estoque: {{ $item->estoque_atual }}
                        @if ($item->estoqueBaixo())
                            <span class="text-red-600">(baixo)</span>
                        @endif
                    @endif
                </p>
                @can('itens.gerir')
                    <a href="{{ route('admin.itens.edit', $item) }}" class="text-blue-600 text-xs hover:underline mt-2 inline-block">Editar</a>
                @endcan
                @can('itens.ver')
                    <a href="{{ route('admin.itens.item-pdf', $item) }}" class="ml-3 text-blue-600 text-xs hover:underline mt-2 inline-block" aria-label="Baixar {{ $item->nome }} em PDF">PDF</a>
                @endcan
            </div>
        </div>
    @empty
        <p class="col-span-4 text-center text-gray-400 py-10">Nenhum item encontrado.</p>
    @endforelse
</div>

<div class="mt-6">{{ $itens->links() }}</div>
@endsection
