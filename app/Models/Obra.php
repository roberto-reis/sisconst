<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "obras";

    protected $fillable = [
        'inicio_real',
        'termino_real',
        'fotos_emergencia',
        'data_fotos_emergencia',
        'fotos_anexo_xiii',
        'data_fotos_anexo_xiii',
        'fiscal_cliente',
        'observacao',
        'id_projeto',
        'id_empreiteiro',
        'id_status_obra',
        'id_usuario'
    ];

    public function projeto() {
        return $this->hasOne(Projeto::class, 'id', 'id_projeto');
    }

    public function statusObra() {
        return $this->hasOne(StatusObra::class, 'id', 'id_status_obra');
    }

    public function empreiteiro() {
        return $this->hasOne(Empreiteiro::class, 'id', 'id_empreiteiro');
    }

}
