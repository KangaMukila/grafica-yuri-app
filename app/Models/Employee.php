<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cargo', 'salario', 'data_admissao', 'bilhete_identidade', 'observacoes',
    ];

    protected $casts = [
        'salario' => 'decimal:2',
        'data_admissao' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
