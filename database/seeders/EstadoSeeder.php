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
            'estado' => 'Asignado'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Respondido'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Derogardo'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Cerrado'
        ]);

        DB::table('estados')->insert([
            'estado' => 'En_revision'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Aprobado'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Rechazado'
        ]);
    }
}
