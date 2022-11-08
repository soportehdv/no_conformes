<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'estado' => 'Registrado'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Aceptado'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Derrogado'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Tramite'
        ]);


    }
}
