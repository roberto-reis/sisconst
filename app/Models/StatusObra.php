<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusObra extends Model
{
    use HasFactory;

    protected $table = "status_obras";

    public $timestamps = false;

    protected $fillable = ['nome'];
}
