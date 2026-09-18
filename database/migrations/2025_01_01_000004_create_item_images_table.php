<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabela "item_images": permite associar VÁRIAS fotos a um único item/serviço.
 * Usa relação polimórfica (imageable) para poder ser reaproveitada por outras
 * entidades no futuro (ex: categorias, banners do site).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_images', function (Blueprint $table) {
            $table->id();
            $table->morphs('imageable'); // imageable_id, imageable_type
            $table->string('caminho');   // path no storage
            $table->string('legenda')->nullable();
            $table->boolean('principal')->default(false); // foto de capa
            $table->unsignedInteger('ordem')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_images');
    }
};
