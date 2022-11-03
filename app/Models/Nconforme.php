<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nconforme extends Model
{
    use HasFactory;

    protected $table = "nconformes";

    protected $fillable = [
        'fReporte',
        'proceso',
        'reportado',
        'descripcion',
        'correccion',
        'fCorreccion',
        'reportante',
        'accion',
        'nDueñoP',
        'fDueñoP',

    ];
}
