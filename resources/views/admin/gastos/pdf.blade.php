<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gastos da Gráfica</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #172334; font-size: 11px; margin: 30px; }
        .header { border-bottom: 3px solid #1683e6; padding-bottom: 14px; }
        .brand { color: #0b5fb3; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        h1 { font-size: 22px; margin: 7px 0 4px; }
        .muted { color: #64748b; }
        table { width: 100%; border-collapse: collapse; margin-top: 22px; }
        th { background: #e9f4fb; color: #0b5fb3; font-size: 10px; text-align: left; }
        th, td { border-bottom: 1px solid #dbe7ef; padding: 8px 7px; }
        th:last-child, td:last-child { text-align: right; }
        .total { margin-top: 18px; text-align: right; color: #0b5fb3; font-size: 14px; font-weight: bold; }
        .footer { border-top: 1px solid #dbe7ef; color: #64748b; font-size: 9px; margin-top: 30px; padding-top: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">{{ \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri') }}</div>
        <h1>Gastos da caixa</h1>
        <div class="muted">Lista gerada em {{ now()->format('d/m/Y H:i') }}</div>
    </div>
    <table>
        <thead><tr><th>Data</th><th>Funcionário</th><th>Categoria</th><th>Descrição</th><th>Valor</th></tr></thead>
        <tbody>
            @forelse($gastos as $gasto)
                <tr><td>{{ $gasto->data->format('d/m/Y') }}</td><td>{{ $gasto->user?->name ?? 'Desconhecido' }}</td><td>{{ match($gasto->categoria) { 'taxi' => 'Táxi', 'alimentacao' => 'Alimentação', default => 'Outros' } }}</td><td>{{ $gasto->descricao }}</td><td>{{ number_format($gasto->valor, 2, ',', '.') }} Kz</td></tr>
            @empty
                <tr><td colspan="5">Nenhum gasto registado.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="total">Total: {{ number_format($gastos->sum('valor'), 2, ',', '.') }} Kz</div>
    <div class="footer">Documento interno de controlo de caixa.</div>
</body>
</html>
