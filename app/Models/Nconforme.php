<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nconforme extends Model
{
    use HasFactory;

    protected $table = "nconformes";

    protected $fillable = [
        'radicado',
        'reportado',
        'fReporte',
        'proceso',
        'nCproceso',
        'nCdescripcion',
        'nCacciones',
        'accion',
        'file',
        'aDescripcion',
        'status',
        'asignado',
        'NcFinalizado'

    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
