<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "categories": agrupa os itens do sistema.
 * "grupo" identifica o bloco geral do pedido do cliente:
 *   custo        -> 1.1 Custo da Gráfica (materiais/insumos internos)
 *   servico      -> 1.2 Serviços prestados pela gráfica
 *   reprografia  -> 1.3 Reprografia
 *   timbragem    -> 1.4 Timbragem
 * Isto permite adicionar novos grupos/categorias no futuro sem alterar o código.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('grupo'); // custo | servico | reprografia | timbragem
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->index('grupo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
