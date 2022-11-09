<?php

namespace Database\Seeders;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'cargo' => 'Administrador',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 1',
            'cargo' => 'GESTION FINANCIERA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 2',
            'cargo' => 'PRESUPUESTO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 3',
            'cargo' => 'CONTABILIDAD',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 4',
            'cargo' => 'FACTURACION',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 5',
            'cargo' => 'TESORERIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 6',
            'cargo' => 'CARTERA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 7',
            'cargo' => 'COSTOS',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 8',
            'cargo' => 'AUDITORIA INTEGRAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 9',
            'cargo' => 'APOYO LOGISTICO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 10',
            'cargo' => 'MANTENIMIENTO BIOMEDICO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 11',
            'cargo' => 'MANTENIMIENTO HOSPITALARIO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 12',
            'cargo' => 'SERVICIO DE ALIMENTOS',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 13',
            'cargo' => 'ASEO Y DESINFECCION',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 14',
            'cargo' => 'GESTION DE TALENTO HUMANO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 15',
            'cargo' => 'SEGURIDAD Y SALUD EN EL TRABAJO Y MEDIO AMBIENTE',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 16',
            'cargo' => 'ALMACEN',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 17',
            'cargo' => 'GESTION DOCUMENTAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 18',
            'cargo' => 'CONTROL INTERNO DISCIPLINARIO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 19',
            'cargo' => 'GESTION JURIDICA Y CONTRACTUAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 20',
            'cargo' => 'GESTION ASISTENCIAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 21',
            'cargo' => 'VIGILANCIA EN SALUD PUBLICA Y EGURIDAD EL PACIENTE',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 22',
            'cargo' => 'ENFERMERIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 23',
            'cargo' => 'COORDINACION MEDICA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 24',
            'cargo' => 'DOCENCIA SERVICIO E INVETIGACION',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 25',
            'cargo' => 'CONSULTA EXTERNA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 26',
            'cargo' => 'URGENCIAS',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 27',
            'cargo' => 'REFERENCIA Y CONTRAREFERENCIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 28',
            'cargo' => 'TRASLADO ASISTENCIAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 29',
            'cargo' => 'HOSPITALIZACION',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 30',
            'cargo' => 'ATENCION DOMICILIARIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 31',
            'cargo' => 'MEDICINA CRITICA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 32',
            'cargo' => 'UNIDAD DE CUIDADO INTENSIVO ADULTOS',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 33',
            'cargo' => 'UNIDAD DE CUIDADO INTENSIVO NEONATAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 34',
            'cargo' => 'UNIDAD DE CUIDADO INTENSIVO PEDIATRICO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 35',
            'cargo' => 'CIRUGIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 36',
            'cargo' => 'GINECOOBSTETRICIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 37',
            'cargo' => 'SALUD MENTAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 38',
            'cargo' => 'APOYO DIAGNOSTICO Y TERAPEUTICO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 39',
            'cargo' => 'LABORATORIO CLINICO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 40',
            'cargo' => 'LABORATORIO DE PATOLOGIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 41',
            'cargo' => 'IMAGENOLOGIA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 42',
            'cargo' => 'HEMODINAMIA Y DIAGNOSTICO CARDIOVASCULAR',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 43',
            'cargo' => 'SOPORTE TERAPEUTICO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 44',
            'cargo' => 'TERAPIAS',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 45',
            'cargo' => 'NUTRICION CLINICA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 46',
            'cargo' => 'SERVICIO FARMACEUTICO',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 47',
            'cargo' => 'BANCO DE SANGRE Y SERVICIO TRANSFUSIONAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 48',
            'cargo' => 'UNIDAD DE SERVICIOS ONCOLOGICOS',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 49',
            'cargo' => 'ATENCION AL USUARIO Y TRABAJO SOCIAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 50',
            'cargo' => 'CONTROL INTERNO DE GESTION',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 51',
            'cargo' => 'GESTION GERENCIAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 52',
            'cargo' => 'GESTION E PLANEACION Y DESARROLLO INSTITUCIONAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 53',
            'cargo' => 'GESTION DE LA CALIDAD',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 54',
            'cargo' => 'GESTION DE ESTADISTICA',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 55',
            'cargo' => 'GESTION DE TECNOLOGIAS INFORMACION Y COMUNICACIONES',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 56',
            'cargo' => 'GESTION COMERCIAL',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);




    }
}
