<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    public const STATUS_PENDENTE = 'pendente';
    public const STATUS_PAGO = 'pago';
    public const STATUS_CANCELADO = 'cancelado';
    public const STATUS_ENTREGUE = 'entregue';

    protected $fillable = [
        'numero', 'vendedor_id', 'cliente_id', 'cliente_nome', 'cliente_telefone',
        'total', 'desconto', 'total_pago', 'forma_pagamento', 'origem', 'status', 'observacoes',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'desconto' => 'decimal:2',
        'total_pago' => 'decimal:2',
    ];

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Recalcula o total da venda com base nas linhas (sale_items).
     */
    public function recalcularTotal(): void
    {
        $subtotal = $this->items()->sum('subtotal');
        $this->total = $subtotal - $this->desconto;
        $this->save();
    }

    /**
     * Gera o próximo número sequencial de venda no formato VD-ANO-000001
     */
    public static function gerarNumero(): string
    {
        $ano = now()->year;
        $ultimo = static::where('numero', 'like', "VD-{$ano}-%")->orderByDesc('id')->first();
        $seq = $ultimo ? ((int) substr($ultimo->numero, -6)) + 1 : 1;

        return sprintf('VD-%d-%06d', $ano, $seq);
    }
}
