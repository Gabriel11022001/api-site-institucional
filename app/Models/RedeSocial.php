<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeSocial extends Model
{
    use HasFactory;

    public $table = 'redes_sociais';
    public $timestamps = false;
    protected $fillable = ['id', 'nome', 'url'];
}
