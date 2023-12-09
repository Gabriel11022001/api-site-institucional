<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up() {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo')
                ->nullable(false)
                ->min(3);
            $table->string('email')
                ->nullable(false)
                ->unique('email_unique_id');
            $table->string('senha')
                ->nullable(false)
                ->min(8)
                ->max(25);
            $table->boolean('status')
                ->nullable(false)
                ->default(true);
            $table->string('nivel_acesso')
                ->nullable(false);
            $table->text('foto_perfil');
        });
    }

    public function down() {
        Schema::dropIfExists('usuarios');
    }
};
