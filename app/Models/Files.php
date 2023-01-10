<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';

    protected $fillable = ([
        'nombre',
        'ruta',
        'mime',
        'extension',
        'size',
        'aDescripcion',
        'noConforme',
    ]);
}
