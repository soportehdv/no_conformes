<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nconforme extends Model
{
    use HasFactory;

    protected $table = "nconformes";

    protected $fillable = [
        'reportado',
        'fReporte',
        'proceso',
        'reportante',
        'nCreportado',
        'nCproceso',
        'nCdescripcion',
        'nCacciones',
        'accion',
        'file',
        'aDescripcion',
        'status'

    ];
}
