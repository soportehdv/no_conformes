<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
            'nombre'        => 'user.png',
            'ruta'          => 'user.png',
            'mime'          => 'image',
            'extension'     => 'png',
            'size'          => '22.4',
            'aDescripcion'   => 'imagen global de usuario',
            'noConforme'    => '0'
        ]);
    }
}
