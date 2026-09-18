<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Serviços e materiais</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #172334; font-size: 10px; margin: 28px; }
        .header { border-bottom: 3px solid #1683e6; padding-bottom: 13px; }
        .brand { color: #0b5fb3; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        h1 { font-size: 21px; margin: 7px 0 4px; }
        .muted { color: #64748b; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #e9f4fb; color: #0b5fb3; font-size: 9px; text-align: left; }
        th, td { border-bottom: 1px solid #dbe7ef; padding: 7px 6px; vertical-align: top; }
        .number { text-align: right; white-space: nowrap; }
        .footer { border-top: 1px solid #dbe7ef; color: #64748b; font-size: 8px; margin-top: 25px; padding-top: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">{{ \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri') }}</div>
        <h1>Serviços e materiais</h1>
        <div class="muted">Lista gerada em {{ now()->format('d/m/Y H:i') }}</div>
    </div>
    <table>
        <thead><tr><th>Nome</th><th>Tipo</th><th>Descrição</th><th>Unidade</th><th class="number">Preço de venda</th><th class="number">Estoque</th><th>Estado</th></tr></thead>
        <tbody>
            @forelse($itens as $item)
                <tr><td><strong>{{ $item->nome }}</strong><br><span class="muted">{{ $item->category?->nome ?? 'Sem categoria' }}</span></td><td>{{ $item->tipo === 'servico' ? 'Serviço' : 'Material' }}</td><td>{{ $item->descricao ?: 'Sem descrição registada.' }}</td><td>{{ $item->unidade }}</td><td class="number">{{ number_format($item->preco_venda ?? 0, 2, ',', '.') }} Kz</td><td class="number">{{ $item->tipo === 'custo' ? $item->estoque_atual : '—' }}</td><td>{{ $item->ativo ? 'Ativo' : 'Inativo' }}</td></tr>
            @empty
                <tr><td colspan="7">Nenhum item encontrado.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">Documento interno de serviços e materiais cadastrados.</div>
</body>
</html>
