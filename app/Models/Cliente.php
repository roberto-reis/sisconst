<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "clientes";

    protected $fillable = [
        'contrato',
        'rasao_social',
        'cnpj',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'inscricao_municipal',
        'inscricao_estadual',
        'classe_servico',
        'valor_urs'
    ];
} 
