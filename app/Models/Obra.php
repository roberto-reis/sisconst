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
        
    ];
}
