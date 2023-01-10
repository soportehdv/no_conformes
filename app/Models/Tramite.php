<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    protected $table = "tramites";

    protected $fillable = [
        'nConforme',
        'proceso',
        'nCproceso',
        'tramite',
        'observacion',
        'file',

    ];
}
