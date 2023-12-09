<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up() {
        Schema::create('configuracao_site', function (Blueprint $table) {
            $table->id();
            $table->text('id_site_hash')
                ->nullable(false);
            $table->string('cor_primaria_hex')
                ->nullable(false)
                ->default('#000000');
            $table->string('cor_secundaria_hex')
                ->nullable(false)
                ->default('#ffffff');
            $table->string('cor_primaria_rgba')
                ->nullable(false)
                ->default('rgba(0, 0, 0, 0.7)');
            $table->text('logo')
                ->nullable(false);
            $table->text('secao_sobre_titulo')
                ->nullable(false);
            $table->text('secao_sobre_conteudo')
                ->nullable(false);
            $table->boolean('apresentar_video_secao_sobre')
                ->nullable(false)
                ->default(true);
            $table->text('video_secao_sobre');
            $table->text('missao')
                ->nullable(false);
            $table->text('visao')
                ->nullable(false);
            $table->text('valores')
                ->nullable(false);
            $table->text('secao_clientes_titulo')
                ->nullable(false);
            $table->text('secao_clientes_conteudo')
                ->nullable(false);
            $table->text('pagina_servicos_titulo')
                ->nullable(false);
            $table->text('pagina_servicos_conteudo')
                ->nullable(false);
            $table->text('pagina_servicos_img_apresentacao')
                ->nullable(false);
            $table->text('pagina_produtos_titulo')
                ->nullable(false);
            $table->text('pagina_produtos_conteudo')
                ->nullable(false);
            $table->text('pagina_produtos_img_apresentacao')
                ->nullable(false);
            $table->text('secao_contato_titulo')
                ->nullable(false);
            $table->text('pagina_blog_titulo')
                ->nullable(false);
            $table->text('pagina_blog_conteudo')
                ->nullable(false);
            $table->string('email_receber_contato_principal')
                ->nullable(false);
            $table->string('email_receber_contato_secundario');
            $table->boolean('receber_contatos_por_email')
                ->nullable(false)
                ->default(true);
            $table->boolean('apresentar_botao_whatsapp')
                ->nullable(false)
                ->default(true);
            $table->string('whatsapp');
        });
    }

    public function down() {
        Schema::dropIfExists('configuracao_site');
    }
};
