<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'imagem_fundo', 'titulo_banner', 'texto_banner', 'url_link_banner', 'status'];
}
