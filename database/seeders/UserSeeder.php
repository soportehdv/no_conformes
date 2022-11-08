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
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 1',
            'cargo' => 'GESTION FINANCIERA',
            'email' => 'nombre 1@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 2',
            'cargo' => 'PRESUPUESTO',
            'email' => 'nombre 2@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 3',
            'cargo' => 'CONTABILIDAD',
            'email' => 'nombre 3@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 4',
            'cargo' => 'FACTURACION',
            'email' => 'nombre 4@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 5',
            'cargo' => 'TESORERIA',
            'email' => 'nombre 5@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 6',
            'cargo' => 'CARTERA',
            'email' => 'nombre 6@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 7',
            'cargo' => 'COSTOS',
            'email' => 'nombre 7@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 8',
            'cargo' => 'AUDITORIA INTEGRAL',
            'email' => 'nombre 8@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 9',
            'cargo' => 'APOYO LOGISTICO',
            'email' => 'nombre 9@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 10',
            'cargo' => 'MANTENIMIENTO BIOMEDICO',
            'email' => 'nombre 10@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 11',
            'cargo' => 'MANTENIMIENTO HOSPITALARIO',
            'email' => 'nombre 11@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 12',
            'cargo' => 'SERVICIO DE ALIMENTOS',
            'email' => 'nombre 12@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 13',
            'cargo' => 'ASEO Y DESINFECCION',
            'email' => 'nombre 13@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 14',
            'cargo' => 'GESTION DE TALENTO HUMANO',
            'email' => 'nombre 14@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 15',
            'cargo' => 'SEGURIDAD Y SALUD EN EL TRABAJO Y MEDIO AMBIENTE',
            'email' => 'nombre 15@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 16',
            'cargo' => 'ALMACEN',
            'email' => 'nombre 16@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 17',
            'cargo' => 'GESTION DOCUMENTAL',
            'email' => 'nombre 17@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 18',
            'cargo' => 'CONTROL INTERNO DISCIPLINARIO',
            'email' => 'nombre 18@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 19',
            'cargo' => 'GESTION JURIDICA Y CONTRACTUAL',
            'email' => 'nombre 19@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 20',
            'cargo' => 'GESTION ASISTENCIAL',
            'email' => 'nombre 20@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 21',
            'cargo' => 'VIGILANCIA EN SALUD PUBLICA Y EGURIDAD EL PACIENTE',
            'email' => 'nombre 21@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 22',
            'cargo' => 'ENFERMERIA',
            'email' => 'nombre 22@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 23',
            'cargo' => 'COORDINACION MEDICA',
            'email' => 'nombre 23@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 24',
            'cargo' => 'DOCENCIA SERVICIO E INVETIGACION',
            'email' => 'nombre 24@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 25',
            'cargo' => 'CONSULTA EXTERNA',
            'email' => 'nombre 25@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 26',
            'cargo' => 'URGENCIAS',
            'email' => 'nombre 26@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 27',
            'cargo' => 'REFERENCIA Y CONTRAREFERENCIA',
            'email' => 'nombre 27@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 28',
            'cargo' => 'TRASLADO ASISTENCIAL',
            'email' => 'nombre 28@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 29',
            'cargo' => 'HOSPITALIZACION',
            'email' => 'nombre 29@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 30',
            'cargo' => 'ATENCION DOMICILIARIA',
            'email' => 'nombre 30@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 31',
            'cargo' => 'MEDICINA CRITICA',
            'email' => 'nombre 31@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 32',
            'cargo' => 'UNIDAD DE CUIDADO INTENSIVO ADULTOS',
            'email' => 'nombre 32@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 33',
            'cargo' => 'UNIDAD DE CUIDADO INTENSIVO NEONATAL',
            'email' => 'nombre 33@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 34',
            'cargo' => 'UNIDAD DE CUIDADO INTENSIVO PEDIATRICO',
            'email' => 'nombre 34@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 35',
            'cargo' => 'CIRUGIA',
            'email' => 'nombre 35@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 36',
            'cargo' => 'GINECOOBSTETRICIA',
            'email' => 'nombre 36@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 37',
            'cargo' => 'SALUD MENTAL',
            'email' => 'nombre 37@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 38',
            'cargo' => 'APOYO DIAGNOSTICO Y TERAPEUTICO',
            'email' => 'nombre 38@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 39',
            'cargo' => 'LABORATORIO CLINICO',
            'email' => 'nombre 39@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 40',
            'cargo' => 'LABORATORIO DE PATOLOGIA',
            'email' => 'nombre 40@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 41',
            'cargo' => 'IMAGENOLOGIA',
            'email' => 'nombre 41@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 42',
            'cargo' => 'HEMODINAMIA Y DIAGNOSTICO CARDIOVASCULAR',
            'email' => 'nombre 42@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 43',
            'cargo' => 'SOPORTE TERAPEUTICO',
            'email' => 'nombre 43@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 44',
            'cargo' => 'TERAPIAS',
            'email' => 'nombre 44@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 45',
            'cargo' => 'NUTRICION CLINICA',
            'email' => 'nombre 45@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 46',
            'cargo' => 'SERVICIO FARMACEUTICO',
            'email' => 'nombre 46@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 47',
            'cargo' => 'BANCO DE SANGRE Y SERVICIO TRANSFUSIONAL',
            'email' => 'nombre 47@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 48',
            'cargo' => 'UNIDAD DE SERVICIOS ONCOLOGICOS',
            'email' => 'nombre 48@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 49',
            'cargo' => 'ATENCION AL USUARIO Y TRABAJO SOCIAL',
            'email' => 'nombre 49@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 50',
            'cargo' => 'CONTROL INTERNO DE GESTION',
            'email' => 'nombre 50@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 51',
            'cargo' => 'GESTION GERENCIAL',
            'email' => 'nombre 51@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 52',
            'cargo' => 'GESTION E PLANEACION Y DESARROLLO INSTITUCIONAL',
            'email' => 'nombre 52@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 53',
            'cargo' => 'GESTION DE LA CALIDAD',
            'email' => 'nombre 53@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 54',
            'cargo' => 'GESTION DE ESTADISTICA',
            'email' => 'nombre 54@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 55',
            'cargo' => 'GESTION DE TECNOLOGIAS INFORMACION Y COMUNICACIONES',
            'email' => 'nombre 55@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);
        DB::table('users')->insert([
            'name' => 'nombre 56',
            'cargo' => 'GESTION COMERCIAL',
            'email' => 'nombre 56@admin.com',
            'password' => bcrypt('1234'),
            'rol' => 'servicios'
        ]);




    }
}
