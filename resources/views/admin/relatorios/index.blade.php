@extends('layouts.admin')

@section('titulo', 'Relatórios e KPIs')

@section('conteudo')
<div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div>
        <p class="eyebrow">Inteligência operacional</p>
        <h2 class="mt-2 text-3xl font-black text-slate-950">Decisões com contexto</h2>
        <p class="mt-2 text-sm text-slate-500">Acompanhe desempenho, procura e pontos de atenção do negócio.</p>
    </div>
    <div class="flex flex-wrap gap-2">
        <button type="button" id="partilhar-relatorio" class="public-outline-button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/></svg> Partilhar</button>
        <a href="{{ route('admin.relatorios.pdf', request()->query()) }}" class="public-primary-button"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"/></svg> Baixar PDF</a>
    </div>
</div>

<form method="GET" class="mb-7 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
        <div><label class="public-label">Data inicial</label><input type="date" name="inicio" value="{{ $inicio->format('Y-m-d') }}" class="public-input"></div>
        <div><label class="public-label">Data final</label><input type="date" name="fim" value="{{ $fim->format('Y-m-d') }}" class="public-input"></div>
        <button class="public-primary-button">Atualizar análise</button>
        <a href="{{ route('admin.relatorios.index') }}" class="public-outline-button">Últimos 30 dias</a>
    </div>
</form>

<div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">
    <div class="kpi-card kpi-blue"><span class="kpi-icon">Kz</span><p>Faturamento</p><strong>{{ number_format($indicadores['faturamento'], 2, ',', '.') }} Kz</strong><small>vendas não canceladas</small></div>
    <div class="kpi-card kpi-amber"><span class="kpi-icon">-</span><p>Despesas da caixa</p><strong>{{ number_format($indicadores['despesas'], 2, ',', '.') }} Kz</strong><small>gastos registados</small></div>
    <div class="kpi-card kpi-green"><span class="kpi-icon">#</span><p>Vendas realizadas</p><strong>{{ $indicadores['vendas'] }}</strong><small>{{ $indicadores['vendas_pagas'] }} pagas no período</small></div>
    <div class="kpi-card kpi-mint"><span class="kpi-icon">↗</span><p>Ticket médio</p><strong>{{ number_format($indicadores['ticket_medio'], 2, ',', '.') }} Kz</strong><small>valor médio por venda</small></div>
    <div class="kpi-card kpi-mint"><span class="kpi-icon">$</span><p>Liquido</p><strong>{{ number_format($indicadores['liquido'], 2, ',', '.') }} Kz</strong><small>após despesas da caixa</small></div>
</div>

<div class="mb-8 grid gap-6 xl:grid-cols-[1.25fr_.75fr]">
    <section class="report-panel"><div class="report-panel-heading"><div><p class="eyebrow">Receita por procura</p><h3>Serviços mais vendidos</h3></div><span class="report-period">{{ $inicio->format('d/m/Y') }} a {{ $fim->format('d/m/Y') }}</span></div><div class="overflow-x-auto"><table class="report-table"><thead><tr><th>Serviço</th><th>Quantidade</th><th class="text-right">Total</th></tr></thead><tbody>@forelse ($topServicos as $servico)<tr><td class="font-semibold text-slate-800">{{ $servico->item_nome }}</td><td>{{ $servico->quantidade }}</td><td class="text-right font-bold text-sky-600">{{ number_format($servico->total, 2, ',', '.') }} Kz</td></tr>@empty<tr><td colspan="3" class="py-8 text-center text-slate-400">Sem vendas no período selecionado.</td></tr>@endforelse</tbody></table></div></section>
    <section class="report-panel"><div class="report-panel-heading"><div><p class="eyebrow">Funil comercial</p><h3>Pedidos online</h3></div></div><div class="space-y-4 p-5"><div class="flex items-center justify-between"><span class="text-sm text-slate-500">Total recebido</span><strong class="text-xl text-slate-900">{{ $indicadores['pedidos'] }}</strong></div>@foreach (['novo' => 'Novos', 'em_analise' => 'Em análise', 'aprovado' => 'Aprovados', 'convertido' => 'Convertidos'] as $status => $label)<div><div class="mb-1 flex justify-between text-xs"><span class="text-slate-500">{{ $label }}</span><strong>{{ $pedidosPorStatus[$status] ?? 0 }}</strong></div><div class="h-2 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-emerald-400" style="width: {{ $indicadores['pedidos'] ? (($pedidosPorStatus[$status] ?? 0) / $indicadores['pedidos']) * 100 : 0 }}%"></div></div></div>@endforeach</div></section>
</div>

<div class="mb-8 grid gap-6 xl:grid-cols-2">
    <section class="report-panel">
        <div class="report-panel-heading">
            <div><p class="eyebrow">Caixa</p><h3>Despesas da caixa</h3></div>
            <a href="{{ route('admin.gastos.index') }}" class="public-card-link">Ver registos <span>→</span></a>
        </div>
        <div class="overflow-x-auto">
            <table class="report-table">
                <thead><tr><th>Categoria</th><th>Valor</th></tr></thead>
                <tbody>
                    @foreach (['taxi' => 'Táxi', 'alimentacao' => 'Alimentação', 'outros' => 'Outros'] as $categoria => $label)
                        <tr>
                            <td class="font-semibold text-slate-800">{{ $label }}</td>
                            <td class="text-right font-bold text-slate-900">{{ number_format($despesasPorCategoria[$categoria] ?? 0, 2, ',', '.') }} Kz</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="report-panel">
        <div class="report-panel-heading">
            <div><p class="eyebrow">Últimos lançamentos</p><h3>Gastos recentes</h3></div>
        </div>
        <div class="space-y-3 p-5">
            @forelse ($despesasRecentes as $despesa)
                <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-slate-800">{{ $despesa->descricao }}</p>
                        <p class="text-xs text-slate-500">{{ match($despesa->categoria) { 'taxi' => 'Táxi', 'alimentacao' => 'Alimentação', default => 'Outros' } }} · {{ $despesa->user?->name ?? 'Funcionário' }} · {{ $despesa->data->format('d/m/Y') }}</p>
                    </div>
                    <strong class="text-sm text-slate-900">-{{ number_format($despesa->valor, 2, ',', '.') }} Kz</strong>
                </div>
            @empty
                <p class="py-8 text-center text-slate-400">Sem gastos registados neste período.</p>
            @endforelse
        </div>
    </section>
</div>

<section class="report-panel"><div class="report-panel-heading"><div><p class="eyebrow">Prevenção</p><h3>Estoque que precisa de atenção</h3></div><a href="{{ route('admin.itens.index') }}" class="public-card-link">Ver materiais <span>→</span></a></div><div class="overflow-x-auto"><table class="report-table"><thead><tr><th>Material</th><th>Estoque atual</th><th>Mínimo recomendado</th><th>Estado</th></tr></thead><tbody>@forelse ($estoqueCritico as $item)<tr><td class="font-semibold text-slate-800">{{ $item->nome }}</td><td>{{ $item->estoque_atual }}</td><td>{{ $item->estoque_minimo }}</td><td><span class="status-badge status-warning">Reposição necessária</span></td></tr>@empty<tr><td colspan="4" class="py-8 text-center text-slate-400">Nenhum material em nível crítico.</td></tr>@endforelse</tbody></table></div></section>

<p id="partilha-estado" class="mt-3 text-right text-xs text-emerald-600" role="status"></p>
@push('scripts')
<script>
    document.getElementById('partilhar-relatorio')?.addEventListener('click', async () => {
        const dados = { title: 'Relatório da Gráfica Yuri', text: 'Relatório de gestão {{ $inicio->format('d/m/Y') }} a {{ $fim->format('d/m/Y') }}', url: window.location.href };
        const estado = document.getElementById('partilha-estado');
        try {
            if (navigator.share) await navigator.share(dados);
            else { await navigator.clipboard.writeText(window.location.href); estado.textContent = 'Link do relatório copiado.'; }
        } catch (erro) { if (erro.name !== 'AbortError') estado.textContent = 'Não foi possível partilhar agora.'; }
    });
</script>
@endpush
@endsection
