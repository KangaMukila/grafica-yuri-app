<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "stock_movements": regista entradas e saídas de materiais
 * (ex: compra de tinta = entrada; uso em serviço = saída), permitindo
 * saber sempre o estoque atual e o histórico/custo de cada material.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('tipo'); // entrada | saida
            $table->integer('quantidade');
            $table->decimal('custo_unitario', 12, 2)->nullable();
            $table->text('motivo')->nullable(); // ex: "Compra fornecedor X", "Uso na venda VD-2026-000123"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
