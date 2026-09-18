<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Constantes dos grupos, para usar em vez de strings soltas no código
    public const GRUPO_CUSTO = 'custo';
    public const GRUPO_SERVICO = 'servico';
    public const GRUPO_REPROGRAFIA = 'reprografia';
    public const GRUPO_TIMBRAGEM = 'timbragem';

    protected $fillable = ['nome', 'grupo', 'slug', 'descricao', 'ativo'];

    protected $casts = ['ativo' => 'boolean'];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function scopeAtivas($query)
    {
        return $query->where('ativo', true);
    }

    public function scopeDoGrupo($query, string $grupo)
    {
        return $query->where('grupo', $grupo);
    }
}
