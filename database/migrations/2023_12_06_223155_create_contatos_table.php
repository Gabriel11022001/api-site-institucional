<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up() {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('contato')
                ->nullable(false)
                ->unique('contato_unique_id');
            $table->boolean('status')
                ->nullable(false)
                ->default(true);
            $table->unsignedBigInteger('tipo_contato_id')
                ->nullable(false);
            $table->foreign('tipo_contato_id')
                ->references('id')
                ->on('tipo_contatos');
        });
    }

    public function down() {
        Schema::dropIfExists('contatos');
    }
};
