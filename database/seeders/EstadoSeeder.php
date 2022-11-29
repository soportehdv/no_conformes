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
            'estado' => 'asignar'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Responder'
        ]);

        DB::table('estados')->insert([
            'estado' => 'derrogar'
        ]);

        DB::table('estados')->insert([
            'estado' => 'cerrar'
        ]);
    }
}
