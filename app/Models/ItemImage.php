<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class ItemImage extends Model
{
    protected $fillable = ['imageable_id', 'imageable_type', 'caminho', 'legenda', 'principal', 'ordem'];

    protected $casts = ['principal' => 'boolean'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    // Acessor rápido para a URL pública da imagem (disco "public")
    public function getUrlAttribute(): string
    {
        if (filter_var($this->caminho, FILTER_VALIDATE_URL)) {
            return $this->caminho;
        }

        return Storage::disk('public')->url($this->caminho);
    }
}
