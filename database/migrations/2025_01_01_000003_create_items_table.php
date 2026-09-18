<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "items": representa tanto materiais de custo interno (tinta, mica, capas...)
 * como serviços vendáveis ao cliente (flyers, banners, cartões, reprografia, timbragem...).
 * O campo "tipo" distingue os dois usos; "categoria_id" liga ao grupo correto.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('nome');
            $table->string('tipo'); // custo | servico
            $table->text('descricao')->nullable();
            $table->decimal('preco_venda', 12, 2)->nullable();   // usado quando tipo = servico
            $table->decimal('preco_custo', 12, 2)->nullable();   // custo de aquisição (materiais)
            $table->string('unidade')->default('unidade');       // unidade, folha, metro, kg, etc.
            $table->integer('estoque_atual')->default(0);        // controlo de stock (materiais)
            $table->integer('estoque_minimo')->default(0);       // alerta de stock baixo
            $table->boolean('disponivel_online')->default(false);// aparece no futuro site público
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->index(['tipo', 'ativo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
