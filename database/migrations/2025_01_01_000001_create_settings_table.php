<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "settings": guarda configurações gerais em formato chave/valor.
 * Permite trocar o nome da gráfica, logotipo, contactos, etc. sem alterar código.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('chave')->unique();      // ex: grafica_nome, grafica_logo, grafica_telefone
            $table->text('valor')->nullable();
            $table->string('tipo')->default('texto'); // texto, imagem, boolean, json
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
