<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up() {
        Schema::create('redes_sociais', function (Blueprint $table) {
            $table->id();
            $table->string('nome')
                ->nullable(false)
                ->unique('nome_unique_id');
            $table->string('url')
                ->nullable(false);
        });
    }

    public function down() {
        Schema::dropIfExists('redes_sociais');
    }
};
