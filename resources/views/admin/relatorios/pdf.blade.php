<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório {{ $inicio->format('d/m/Y') }} a {{ $fim->format('d/m/Y') }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #172334; font-size: 11px; margin: 24px; }
        h1 { font-size: 22px; margin: 0 0 4px; }
        h2 { font-size: 14px; margin: 22px 0 8px; color: #0b5fb3; }
        .header { border-bottom: 3px solid #1683e6; padding-bottom: 14px; }
        .period { color: #64748b; }
        .cards { width: 100%; margin: 18px 0; }
        .card { display: inline-block; width: 23%; margin-right: 1%; padding: 11px 8px; background: #eef7fd; border-radius: 6px; vertical-align: top; }
        .card:last-child { margin-right: 0; }
        .card p { margin: 0 0 7px; color: #526579; font-size: 10px; }
        .card strong { font-size: 15px; color: #0b5fb3; }
        .card small { display: block; margin-top: 5px; color: #64748b; font-size: 9px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th { background: #e9f4fb; color: #0b5fb3; text-align: left; font-size: 10px; }
        th, td { padding: 7px; border-bottom: 1px solid #dbe7ef; }
        td:last-child, th:last-child { text-align: right; }
        .section { page-break-inside: avoid; }
        .footer { margin-top: 30px; border-top: 1px solid #dbe7ef; padding-top: 8px; color: #64748b; font-size: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de gestão</h1>
        <div class="period">Período: {{ $inicio->format('d/m/Y') }} a {{ $fim->format('d/m/Y') }}</div>
    </div>

    <div class="cards">
        <div class="card"><p>Faturamento</p><strong>{{ number_format($indicadores['faturamento'], 2, ',', '.') }} Kz</strong><small>vendas não canceladas</small></div>
        <div class="card"><p>Despesas da caixa</p><strong>{{ number_format($indicadores['despesas'], 2, ',', '.') }} Kz</strong><small>gastos registados</small></div>
        <div class="card"><p>Liquido</p><strong>{{ number_format($indicadores['liquido'], 2, ',', '.') }} Kz</strong><small>após despesas</small></div>
        <div class="card"><p>Pedidos online</p><strong>{{ $indicadores['pedidos'] }}</strong><small>recebidos no período</small></div>
    </div>

    <div class="section">
        <h2>Vendas realizadas</h2>
        <table>
            <thead><tr><th>Venda</th><th>Cliente</th><th>Itens</th><th>Status</th><th>Total</th></tr></thead>
            <tbody>
                @forelse($vendasLista as $venda)
                    <tr>
                        <td>{{ $venda->numero }}<br><small>{{ $venda->created_at->format('d/m/Y H:i') }}</small></td>
                        <td>{{ $venda->cliente_nome ?: 'Consumidor final' }}</td>
                        <td>@foreach($venda->items as $linha){{ $linha->quantidade }}x {{ $linha->item_nome }}@if($linha->detalhes) ({{ $linha->detalhes }})@endif<br>@endforeach</td>
                        <td>{{ ['pendente' => 'Pendente', 'pago' => 'Paga', 'entregue' => 'Entregue', 'cancelado' => 'Cancelada'][$venda->status] ?? $venda->status }}</td>
                        <td>{{ number_format($venda->total, 2, ',', '.') }} Kz</td>
                    </tr>
                @empty
                    <tr><td colspan="5">Sem vendas no período.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Serviços mais vendidos</h2>
        <table>
            <thead><tr><th>Serviço</th><th>Quantidade</th><th>Total</th></tr></thead>
            <tbody>
                @forelse($topServicos as $servico)
                    <tr><td>{{ $servico->item_nome }}</td><td>{{ $servico->quantidade }}</td><td>{{ number_format($servico->total, 2, ',', '.') }} Kz</td></tr>
                @empty
                    <tr><td colspan="3">Sem vendas no período.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Serviços disponíveis</h2>
        <table>
            <thead><tr><th>Serviço</th><th>Descrição</th><th>Unidade</th><th>Preço</th></tr></thead>
            <tbody>
                @forelse($servicos as $servico)
                    <tr><td>{{ $servico->nome }}</td><td>{{ $servico->descricao ?: 'Sem descrição registada.' }}</td><td>{{ $servico->unidade }}</td><td>{{ number_format($servico->preco_venda, 2, ',', '.') }} Kz</td></tr>
                @empty
                    <tr><td colspan="4">Nenhum serviço disponível.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Materiais disponíveis</h2>
        <table>
            <thead><tr><th>Material</th><th>Descrição</th><th>Estoque</th><th>Unidade</th><th>Preço</th></tr></thead>
            <tbody>
                @forelse($materiais as $material)
                    <tr><td>{{ $material->nome }}</td><td>{{ $material->descricao ?: 'Sem descrição registada.' }}</td><td>{{ $material->estoque_atual }} / min. {{ $material->estoque_minimo }}</td><td>{{ $material->unidade }}</td><td>{{ number_format($material->preco_venda, 2, ',', '.') }} Kz</td></tr>
                @empty
                    <tr><td colspan="5">Nenhum material disponível.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Despesas da caixa por categoria</h2>
        <table>
            <thead><tr><th>Categoria</th><th>Valor</th></tr></thead>
            <tbody>
                @foreach (['taxi' => 'Táxi', 'alimentacao' => 'Alimentação', 'outros' => 'Outros'] as $categoria => $label)
                    <tr><td>{{ $label }}</td><td>{{ number_format($despesasPorCategoria[$categoria] ?? 0, 2, ',', '.') }} Kz</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Pedidos online</h2>
        <table>
            <thead><tr><th>Status</th><th>Quantidade</th></tr></thead>
            <tbody>
                @foreach(['novo' => 'Novos', 'em_analise' => 'Em análise', 'aprovado' => 'Aprovados', 'convertido' => 'Convertidos'] as $status => $label)
                    <tr><td>{{ $label }}</td><td>{{ $pedidosPorStatus[$status] ?? 0 }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Estoque crítico</h2>
        <table>
            <thead><tr><th>Material</th><th>Atual</th><th>Mínimo</th><th>Estado</th></tr></thead>
            <tbody>
                @forelse($estoqueCritico as $item)
                    <tr><td>{{ $item->nome }}</td><td>{{ $item->estoque_atual }}</td><td>{{ $item->estoque_minimo }}</td><td>Reposição necessária</td></tr>
                @empty
                    <tr><td colspan="4">Nenhum material crítico.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">Relatório gerado em {{ now()->format('d/m/Y H:i') }}.</div>
</body>
</html>

