<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "employees": dados profissionais do funcionário.
 * Está sempre ligada 1-para-1 a um registo em "users" (que trata do login/role).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('cargo');                 // ex: Designer, Operador de Reprografia
            $table->decimal('salario', 12, 2)->nullable();
            $table->date('data_admissao')->nullable();
            $table->string('bilhete_identidade')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
