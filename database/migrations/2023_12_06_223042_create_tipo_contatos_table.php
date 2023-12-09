<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up() {
        Schema::create('tipo_contatos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')
                ->nullable(false)
                ->unique('descricao_unique_id');
        });
    }

    public function down() {
        Schema::dropIfExists('tipo_contatos');
    }
};
