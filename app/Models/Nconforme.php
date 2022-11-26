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
        'nCproceso',
        'nCdescripcion',
        'nCacciones',
        'accion',
        'file',
        'aDescripcion',
        'status'

    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
