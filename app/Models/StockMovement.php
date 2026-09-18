<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    public const TIPO_ENTRADA = 'entrada';
    public const TIPO_SAIDA = 'saida';

    protected $fillable = ['item_id', 'user_id', 'tipo', 'quantidade', 'custo_unitario', 'motivo'];

    protected $casts = ['custo_unitario' => 'decimal:2'];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Regista o movimento e já atualiza o estoque_atual do item.
     */
    public static function registar(Item $item, string $tipo, int $quantidade, ?float $custoUnitario, ?string $motivo, ?int $userId): self
    {
        $movimento = static::create([
            'item_id' => $item->id,
            'user_id' => $userId,
            'tipo' => $tipo,
            'quantidade' => $quantidade,
            'custo_unitario' => $custoUnitario,
            'motivo' => $motivo,
        ]);

        $item->estoque_atual += $tipo === self::TIPO_ENTRADA ? $quantidade : -$quantidade;
        $item->save();

        return $movimento;
    }
}
