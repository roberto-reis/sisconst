<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "projetos";

    protected $fillable = [
        'projeto',
        'id_estacao',
        'data_oe',
        'numero_oe_oc',
        'endereco',
        'bairro',
        'municipio',
        'uf',
        'pc_rv',
        'descricao_servico',
        'inicio_previsto',
        'termino_previsto',
        'supervisor',
        'licenca',
        'inicio_licenca',
        'termino_licenca',
        'valor_urs',
        'valor_projetado',
        'comprimento_galeria',
        'id_cliente',
        'id_tipo_servico'
    ];
}
