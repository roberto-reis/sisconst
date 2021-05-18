<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacao extends Model
{
    use HasFactory;

    protected $table = "estacoes";

    public $timestamps = false;

    protected $fillable = [
        'sigla',
        'descricao',
        'municipio'
    ];


    public function projeto() {
        return $this->hasMany(Projeto::class, 'id_estacao', 'id');
    }

    
}
