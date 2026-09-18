<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "sales": cabeçalho de cada venda/pedido realizado na gráfica
 * (balcão) ou submetido futuramente pelo site público.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique(); // ex: VD-2026-000123
            $table->foreignId('vendedor_id')->nullable()->constrained('users')->nullOnDelete(); // funcionário que registou
            $table->foreignId('cliente_id')->nullable()->constrained('users')->nullOnDelete();  // cliente (opcional)
            $table->string('cliente_nome')->nullable();   // quando não há conta de cliente
            $table->string('cliente_telefone')->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('desconto', 12, 2)->default(0);
            $table->decimal('total_pago', 12, 2)->default(0);
            $table->string('forma_pagamento')->default('dinheiro'); // dinheiro, transferencia, multicaixa
            $table->string('origem')->default('balcao'); // balcao | online (para o futuro site)
            $table->string('status')->default('pendente'); // pendente, pago, cancelado, entregue
            $table->text('observacoes')->nullable();
            $table->timestamps();

            $table->index(['status', 'origem']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
