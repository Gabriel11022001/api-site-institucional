<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContato extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'descricao',
        'status'
    ];

    public function contatos() {

        return $this->hasMany(Contato::class);
    }
}
