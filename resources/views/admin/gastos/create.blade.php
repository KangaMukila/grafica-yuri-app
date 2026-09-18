@extends('layouts.admin')

@section('titulo', 'Registar gasto da caixa')

@section('conteudo')
<div class="mx-auto max-w-2xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="mb-6">
        <p class="eyebrow">Caixa / despesas</p>
        <h2 class="mt-2 text-2xl font-black text-slate-950">Adicionar gasto do funcionário</h2>
        <p class="mt-2 text-sm text-slate-500">Registe despesas reais de táxi, alimentação ou outros custos retirados da caixa do dia.</p>
    </div>

    <form method="POST" action="{{ route('admin.gastos.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="public-label">Categoria</label>
            <select name="categoria" class="public-input" required>
                <option value="">Selecione...</option>
                <option value="taxi">Táxi</option>
                <option value="alimentacao">Alimentação</option>
                <option value="outros">Outros</option>
            </select>
        </div>

        <div>
            <label class="public-label">Descrição</label>
            <input type="text" name="descricao" value="{{ old('descricao') }}" class="public-input" placeholder="Ex.: Táxi para visita ao cliente" required>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="public-label">Valor (Kz)</label>
                <input type="number" step="0.01" min="0.01" name="valor" value="{{ old('valor') }}" class="public-input" required>
            </div>
            <div>
                <label class="public-label">Data</label>
                <input type="date" name="data" value="{{ old('data', now()->toDateString()) }}" class="public-input" required>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.gastos.index') }}" class="public-outline-button">Cancelar</a>
            <button type="submit" class="public-primary-button">Guardar gasto</button>
        </div>
    </form>
</div>
@endsection
