<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Item extends Model
{
    use HasFactory;

    public const TIPO_CUSTO = 'custo';
    public const TIPO_SERVICO = 'servico';

    protected $fillable = [
        'category_id', 'nome', 'tipo', 'descricao', 'preco_venda', 'preco_custo',
        'unidade', 'estoque_atual', 'estoque_minimo', 'disponivel_online', 'ativo',
    ];

    protected $casts = [
        'preco_venda' => 'decimal:2',
        'preco_custo' => 'decimal:2',
        'disponivel_online' => 'boolean',
        'ativo' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(ItemImage::class, 'imageable')->orderBy('ordem');
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function imagemPrincipal(): ?ItemImage
    {
        return $this->images->firstWhere('principal', true) ?? $this->images->first();
    }

    public function scopeServicos($query)
    {
        return $query->where('tipo', self::TIPO_SERVICO);
    }

    public function scopeMateriais($query)
    {
        return $query->where('tipo', self::TIPO_CUSTO);
    }

    public function scopeAtivos($query)
    {
        return $query->where('ativo', true);
    }

    public function scopeDisponivelOnline($query)
    {
        return $query->where('disponivel_online', true)->where('ativo', true);
    }

    public function estoqueBaixo(): bool
    {
        return $this->tipo === self::TIPO_CUSTO && $this->estoque_atual <= $this->estoque_minimo;
    }
}
