<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Projeto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "projetos";

    protected $fillable = [
        'num_projeto',
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
        'valor_projetado',
        'comprimento_galeria',
        'id_cliente',
        'id_tipo_servico'
    ];

    public function estacao() {
        return $this->hasOne(Estacao::class, 'id', 'id_estacao');
    }

    public function cliente() {
        return $this->hasOne(Cliente::class, 'id', 'id_cliente');
    }

    public function tipoServico() {
        return $this->hasOne(TipoServico::class, 'id', 'id_tipo_servico');
    }

    public function supervisor() {
        return $this->hasOne(Supervisor::class, 'id', 'id_supervisor');
    }

    public function obras() {
        return $this->hasMany(Obra::class, 'id_projeto', 'id');
    }

}
