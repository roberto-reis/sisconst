<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empreiteiro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "empreiteiros";

    protected $fillable = ['nome'];
}
