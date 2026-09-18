<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "service_requests": pedidos de serviço submetidos pelo cliente
 * através do futuro site público. Um pedido aprovado pela gráfica pode
 * ser convertido numa "sale" (venda) pelo funcionário/gerente.
 *
 * Esta tabela já existe desde já no sistema local, apenas fica "adormecida"
 * até o site público ser ligado — assim não é preciso redesenhar a base de dados depois.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('cliente_nome');
            $table->string('cliente_telefone');
            $table->string('cliente_email')->nullable();
            $table->foreignId('item_id')->constrained();
            $table->text('descricao'); // detalhes do pedido (tamanho, quantidade, cores, prazo...)
            $table->string('status')->default('novo'); // novo, em_analise, aprovado, rejeitado, convertido
            $table->foreignId('sale_id')->nullable()->constrained('sales')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
