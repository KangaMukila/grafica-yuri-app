<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>{{ $item->nome }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #172334; font-size: 11px; margin: 30px; }
        .header { border-bottom: 3px solid #1683e6; padding-bottom: 16px; }
        .brand { color: #0b5fb3; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        h1 { font-size: 25px; margin: 8px 0 4px; }
        .muted { color: #64748b; }
        .badge { display: inline-block; margin-top: 10px; background: #e9f4fb; color: #0b5fb3; padding: 5px 8px; font-size: 10px; font-weight: bold; }
        .details { width: 100%; margin-top: 25px; }
        .details td { width: 50%; border-bottom: 1px solid #dbe7ef; padding: 10px 0; vertical-align: top; }
        .label { color: #64748b; font-size: 9px; text-transform: uppercase; }
        .value { margin-top: 4px; font-weight: bold; }
        .description { background: #f1fbf5; border-left: 3px solid #bde8ce; margin-top: 25px; padding: 12px; line-height: 1.6; }
        .footer { border-top: 1px solid #dbe7ef; color: #64748b; font-size: 9px; margin-top: 30px; padding-top: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">{{ \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri') }}</div>
        <h1>{{ $item->nome }}</h1>
        <div class="muted">Ficha gerada em {{ now()->format('d/m/Y H:i') }}</div>
        <span class="badge">{{ $item->tipo === 'servico' ? 'Serviço' : 'Material' }} · {{ $item->category?->nome ?? 'Sem categoria' }}</span>
    </div>
    <table class="details">
        <tr><td><div class="label">Preço de venda</div><div class="value">{{ number_format($item->preco_venda ?? 0, 2, ',', '.') }} Kz</div></td><td><div class="label">Unidade</div><div class="value">{{ $item->unidade }}</div></td></tr>
        <tr><td><div class="label">Estado</div><div class="value">{{ $item->ativo ? 'Ativo' : 'Inativo' }}</div></td><td><div class="label">Disponível online</div><div class="value">{{ $item->disponivel_online ? 'Sim' : 'Não' }}</div></td></tr>
        @if($item->tipo === 'custo')
            <tr><td><div class="label">Estoque atual</div><div class="value">{{ $item->estoque_atual }}</div></td><td><div class="label">Estoque mínimo</div><div class="value">{{ $item->estoque_minimo }}</div></td></tr>
        @endif
    </table>
    <div class="description"><strong>Descrição</strong><br>{{ $item->descricao ?: 'Sem descrição registada.' }}</div>
    <div class="footer">Ficha interna de serviço/material. Documento gerado pelo sistema de gestão.</div>
</body>
</html>
