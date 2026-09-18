<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adiciona campos extra à tabela nativa "users" do Laravel.
 * O nível de acesso (admin, gerente, funcionário, cliente) é controlado
 * pelo pacote spatie/laravel-permission (tabelas roles/permissions),
 * não por uma coluna fixa, para poder criar novos níveis facilmente.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefone')->nullable()->after('email');
            $table->string('nif')->nullable()->after('telefone'); // usado por clientes empresa
            $table->boolean('ativo')->default(true)->after('nif');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telefone', 'nif', 'ativo']);
        });
    }
};
