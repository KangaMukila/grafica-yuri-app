<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Venda {{ $venda->numero }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #172334; font-size: 11px; margin: 30px; }
        .header { border-bottom: 3px solid #1683e6; padding-bottom: 16px; }
        .brand { color: #0b5fb3; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        h1 { font-size: 24px; margin: 7px 0 4px; }
        .muted { color: #64748b; }
        .meta { width: 100%; margin: 20px 0; }
        .meta td { width: 50%; padding: 4px 0; vertical-align: top; }
        .label { color: #64748b; font-size: 9px; text-transform: uppercase; }
        .value { margin-top: 3px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #e9f4fb; color: #0b5fb3; font-size: 10px; text-align: left; }
        th, td { border-bottom: 1px solid #dbe7ef; padding: 9px 7px; vertical-align: top; }
        th:nth-child(2), td:nth-child(2) { text-align: center; width: 55px; }
        th:nth-child(3), th:nth-child(4), td:nth-child(3), td:nth-child(4) { text-align: right; width: 100px; }
        .description { color: #64748b; font-size: 9px; line-height: 1.4; margin-top: 3px; }
        .totals { width: 260px; margin: 18px 0 0 auto; }
        .totals td { border: 0; padding: 5px 0; }
        .total td { border-top: 2px solid #1683e6; color: #0b5fb3; font-size: 14px; font-weight: bold; padding-top: 9px; }
        .notes { border-left: 3px solid #bde8ce; background: #f1fbf5; margin-top: 24px; padding: 10px 12px; }
        .footer { border-top: 1px solid #dbe7ef; color: #64748b; font-size: 9px; margin-top: 30px; padding-top: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">{{ \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri') }}</div>
        <h1>Venda {{ $venda->numero }}</h1>
        <div class="muted">Documento emitido em {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <table class="meta">
        <tr>
            <td><div class="label">Cliente</div><div class="value">{{ $venda->cliente?->name ?? $venda->cliente_nome ?? 'Consumidor final' }}</div>@if($venda->cliente_telefone)<div class="muted">{{ $venda->cliente_telefone }}</div>@endif</td>
            <td><div class="label">Data da venda</div><div class="value">{{ $venda->created_at->format('d/m/Y H:i') }}</div><div class="muted">Vendedor: {{ $venda->vendedor?->name ?? '—' }}</div></td>
        </tr>
        <tr>
            <td><div class="label">Forma de pagamento</div><div class="value">{{ ucfirst($venda->forma_pagamento) }}</div></td>
            <td><div class="label">Estado</div><div class="value">{{ ucfirst($venda->status) }}</div></td>
        </tr>
    </table>

    <table>
        <thead><tr><th>Serviço ou material</th><th>Qtd.</th><th>Preço unitário</th><th>Subtotal</th></tr></thead>
        <tbody>
            @foreach ($venda->items as $linha)
                <tr>
                    <td><strong>{{ $linha->item_nome }}</strong>@if($linha->detalhes)<div class="description">{{ $linha->detalhes }}</div>@endif</td>
                    <td>{{ $linha->quantidade }}</td>
                    <td>{{ number_format($linha->preco_unitario, 2, ',', '.') }} Kz</td>
                    <td>{{ number_format($linha->subtotal, 2, ',', '.') }} Kz</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr><td>Desconto</td><td style="text-align:right">{{ number_format($venda->desconto, 2, ',', '.') }} Kz</td></tr>
        <tr class="total"><td>Total</td><td style="text-align:right">{{ number_format($venda->total, 2, ',', '.') }} Kz</td></tr>
        <tr><td>Valor pago</td><td style="text-align:right">{{ number_format($venda->total_pago, 2, ',', '.') }} Kz</td></tr>
    </table>

    @if ($venda->observacoes)
        <div class="notes"><strong>Observações</strong><br>{{ $venda->observacoes }}</div>
    @endif

    <div class="footer">Documento interno de venda. Este PDF contém a descrição dos serviços e materiais registados nesta operação.</div>
</body>
</html>
