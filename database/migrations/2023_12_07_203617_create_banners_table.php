<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up() {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->text('imagem_fundo')
                ->nullable(false);
            $table->string('titulo_banner')
                ->nullable(false)
                ->unique('titulo_banner_unique_id');
            $table->text('texto_banner')
                ->nullable(false);
            $table->string('url_link_banner')
                ->nullable(false);
            $table->boolean('status')
                ->nullable(false)
                ->default(true);
        });
    }

    public function down() {
        Schema::dropIfExists('banners');
    }
};
