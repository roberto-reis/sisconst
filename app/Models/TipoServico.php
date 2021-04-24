<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServico extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "tipo_servicos";

    protected $fillable = ['nome'];
}
