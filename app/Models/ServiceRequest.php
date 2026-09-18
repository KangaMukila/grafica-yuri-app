<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    public const STATUS_NOVO = 'novo';
    public const STATUS_EM_ANALISE = 'em_analise';
    public const STATUS_APROVADO = 'aprovado';
    public const STATUS_REJEITADO = 'rejeitado';
    public const STATUS_CONVERTIDO = 'convertido';

    protected $fillable = [
        'cliente_id', 'cliente_nome', 'cliente_telefone', 'cliente_email',
        'item_id', 'descricao', 'status', 'sale_id',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
