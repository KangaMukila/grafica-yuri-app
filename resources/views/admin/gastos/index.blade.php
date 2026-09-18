@extends('layouts.admin')

@section('titulo', 'Despesas da caixa')

@section('conteudo')
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="eyebrow">Controlo de caixa</p>
        <h2 class="mt-2 text-2xl font-black text-slate-950">Gastos registados pelos funcionários</h2>
    </div>

    <div class="flex flex-wrap gap-2">
        @can('gastos.ver')
            <a href="{{ route('admin.gastos.pdf') }}" class="public-outline-button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"/></svg> Baixar PDF</a>
        @endcan
        @can('gastos.gerir')
            <a href="{{ route('admin.gastos.create') }}" class="public-primary-button">+ Novo gasto</a>
        @endcan
    </div>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="report-table">
            <thead>
                <tr>
                    <th>Funcionário</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th class="text-right">Valor</th>
                    <th class="text-right">Documento</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gastos as $gasto)
                    <tr>
                        <td class="font-semibold text-slate-800">{{ $gasto->user?->name ?? 'Desconhecido' }}</td>
                        <td>
                            <span class="status-badge {{ $gasto->categoria === 'taxi' ? 'status-warning' : ($gasto->categoria === 'alimentacao' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700') }}">
                                {{ match($gasto->categoria) { 'taxi' => 'Táxi', 'alimentacao' => 'Alimentação', default => 'Outros' } }}
                            </span>
                        </td>
                        <td>{{ $gasto->descricao }}</td>
                        <td>{{ $gasto->data->format('d/m/Y') }}</td>
                        <td class="text-right font-bold text-slate-900">{{ number_format($gasto->valor, 2, ',', '.') }} Kz</td>
                        <td class="text-right"><a href="{{ route('admin.gastos.pdf') }}" class="text-blue-600 hover:underline" aria-label="Baixar lista de gastos em PDF">PDF</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">Nenhum gasto registado até ao momento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5">{{ $gastos->links() }}</div>
@endsection
