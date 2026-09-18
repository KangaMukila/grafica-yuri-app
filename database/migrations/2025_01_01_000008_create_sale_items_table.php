<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "sale_items": cada linha de produto/serviço dentro de uma venda.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_id')->constrained()->restrictOnDelete();
            $table->string('item_nome');           // snapshot do nome no momento da venda
            $table->integer('quantidade')->default(1);
            $table->decimal('preco_unitario', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->text('detalhes')->nullable();  // ex: tamanho, cores, texto do timbre
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
