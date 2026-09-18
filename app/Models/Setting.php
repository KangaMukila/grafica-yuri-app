<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['chave', 'valor', 'tipo'];

    /**
     * Vai buscar o valor de uma configuração pela chave.
     * Ex: Setting::get('grafica_nome', 'Gráfica Yuri')
     */
    public static function get(string $chave, $default = null)
    {
        return Cache::rememberForever("setting:{$chave}", function () use ($chave, $default) {
            return static::where('chave', $chave)->value('valor') ?? $default;
        });
    }

    /**
     * Define/atualiza uma configuração e limpa a cache.
     */
    public static function set(string $chave, $valor, string $tipo = 'texto'): void
    {
        static::updateOrCreate(['chave' => $chave], ['valor' => $valor, 'tipo' => $tipo]);
        Cache::forget("setting:{$chave}");
    }
}
