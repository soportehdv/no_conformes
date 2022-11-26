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
            'proceso'   => 'Sistemas',
            'email' => 'jhonrymat@gmail.com',
            'password' => bcrypt('1234'),
            'rol' => 'admin'
        ]);
        DB::table('users')->insert([
            'name'      => 'Maryury Diaz Cespedes',
            'cargo'     => 'Gerente',
            'proceso'   => 'Gestión Gerencial',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Clarena Patricia Celis Castaño',
            'cargo'     => 'Jefe Oficina Comercial',
            'proceso'   => 'Gestión Comercial',
            'email'     => 'appsheethdv@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Luz Marina Londoño Vargas',
            'cargo'     => 'Jefe Oficina Asesora de Planeación y Desarrollo Institucional',
            'proceso'   => 'Gestión de Planeación y Desarrollo Institucional',
            'email'     => 'guiargooficial@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Silvia Alexandra Sandoval Candela',
            'cargo'     => 'Coordinador de Calidad',
            'proceso'   => 'Gestion de Calidad',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Eduardo Garcia',
            'cargo'     => 'Coordinador Estadistica',
            'proceso'   => 'Estadistica',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Luz Mary Sanabria Vargas',
            'cargo'     => 'Jefe Oficina Asesora de Planeación y Desarrollo Institucional/Coordinador Unidad Funcional de Tecnologías de la Información y las Comunicaciones',
            'proceso'   => 'Gestión de Tecnologías, Información y Comunicaciones',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Alex Warff Mercado',
            'cargo'     => 'Subgerente Asistencial',
            'proceso'   => 'Gestión Asistencial',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Angela Gomez Neira',
            'cargo'     => 'Medica epidemiologia',
            'proceso'   => 'Epidemiologia',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Norton Perez Gutierrez',
            'cargo'     => 'Coordinador Unidad Funcional de Medicina Crítica',
            'proceso'   => 'Medicina Crítica',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Haydee Castro Murcia',
            'cargo'     => 'Coordinador Unidad Funcional de Apoyo Diagnóstico y Terapéutico',
            'proceso'   => 'Apoyo Diagnóstico',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Yady Cagua',
            'cargo'     => 'Coordinador imagenologia',
            'proceso'   => 'Imagenologia',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Jennifer Cediel',
            'cargo'     => 'Profesional Hemodinamia',
            'proceso'   => 'Hemodinamia',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Magda Carolina Neuque Rico',
            'cargo'     => 'Coordinador Unidad Laboratorio clinico ',
            'proceso'   => 'Laboratorio Clinico',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Haydee Castro Murcia',
            'cargo'     => 'Coordinador Unidad Funcional de Apoyo Diagnóstico y Terapéutico',
            'proceso'   => 'Laboratorio Patologia',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Ana Maria Salinas Varon',
            'cargo'     => 'Coordinador Terapia Fisica',
            'proceso'   => 'Terapia Fisica',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Sandra  Soto',
            'cargo'     => 'Coordinador Terapia Respiratoria',
            'proceso'   => 'Terapia Respiratoria',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Nohora Gutierrez ',
            'cargo'     => 'Coordinador Unidad Funcional de Apoyo Diagnóstico y Terapéutico',
            'proceso'   => 'Banco de Sangre y Servicio Transfusional',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Andrea Prieto',
            'cargo'     => 'Coordinador Unidad Funcional de Urgencias',
            'proceso'   => 'Urgencias',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Bibiana Salgado Caballero',
            'cargo'     => 'Coordinador Unidad Funcional de Cirugía',
            'proceso'   => 'Cirugía',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Linda Guarin',
            'cargo'     => 'Coordinador Unidad Funcional de Ginecoobstetricia',
            'proceso'   => 'Ginecoobstetricia',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Claudia Goyeneche',
            'cargo'     => 'Coordinador Unidad Funcional de Hospitalización',
            'proceso'   => 'Hospitalización',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Ihering Janeth Baquero',
            'cargo'     => 'Coordinador Unidad Funcional de Consulta Externa',
            'proceso'   => 'Consulta Externa',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Gloria Velez',
            'cargo'     => 'Coordinador Unidad Funcional de Atención al Usuario',
            'proceso'   => 'Atención al Usuario y Trabajo Social',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Claudia Goyeneche',
            'cargo'     => 'Coordinador Unidad Funcional de Hospitalización',
            'proceso'   => 'Atención Domiciliaria',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Linda Guarin-Claudia Goyeneche',
            'cargo'     => 'Coordinador Unidad Funcional de Salud Mental',
            'proceso'   => 'Salud Mental',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Jose Lucas Rodriguez Mora',
            'cargo'     => 'Coordinador Unidad Funcional de Apoyo Diagnóstico y Terapéutico',
            'proceso'   => 'Servicio Farmacéutico',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Yeny Angelina Paredes ',
            'cargo'     => 'Coordinador Unidad Funcional de Servicios Oncológicos',
            'proceso'   => 'Unidad de Servicios Oncológicos',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Johanna Castañeda',
            'cargo'     => 'Coordinador Docencia y Servicio ',
            'proceso'   => 'Docencia, Servicio e Investigación',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Erika Paola Lopez Guerrero',
            'cargo'     => 'Subgerente Financiero',
            'proceso'   => 'Gestión Financiera',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Luz Nelly Hurtado',
            'cargo'     => 'Coordinadora de Cartera',
            'proceso'   => 'Cartera',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Fernando Castañeda',
            'cargo'     => 'Contador',
            'proceso'   => 'Contabilidad',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Clarena Patricia Celis Castaño',
            'cargo'     => 'Jefe Oficina Asesora de Planeación y Desarrollo Institucional',
            'proceso'   => 'Costos',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Rocio del Pilar Contreras Califa',
            'cargo'     => 'Interventora Facturacion',
            'proceso'   => 'Facturacion',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Consuelo Cardenas Buitrago',
            'cargo'     => 'Coordinadora de Presupuesto',
            'proceso'   => 'Presupuesto',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Mayerly Avendaño',
            'cargo'     => 'Tesorera',
            'proceso'   => 'Tesoreria',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Maria Claudia Caballero Prieto',
            'cargo'     => 'Subgerente Financiero',
            'proceso'   => 'Auditoría Integral',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Magda Andrea Peñuela Higuera',
            'cargo'     => 'Subgerente Administrativo',
            'proceso'   => 'Apoyo Logístico',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Elsa Ligia Figueroa Saray',
            'cargo'     => 'Jefe Unidad Funcional de Talento Humano',
            'proceso'   => 'Gestión de Talento Humano',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Alvaro Jose Rojas Delgadillo',
            'cargo'     => 'Profesional Universitario seguridad y salud en el trabajo',
            'proceso'   => 'Seguridad y salud en el trabajo',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Stephania Aldana Coronado',
            'cargo'     => 'Profesional Universitario Ingeniera Ambiental',
            'proceso'   => 'Medio Ambiente',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Stephania Aldana Coronado',
            'cargo'     => 'Profesional Universitario Ingeniera Ambiental',
            'proceso'   => 'Aseo y Desinfeccion',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Marly Johana Valencia Granados',
            'cargo'     => 'Interventora Servicio de alimentos',
            'proceso'   => 'Servicio de Alimentos',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Leidy Ruiz',
            'cargo'     => 'Jefe Unidad Funcional Gestión Documental',
            'proceso'   => 'Gestión Documental',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Gustavo Adolfo Sanchez Martinez',
            'cargo'     => 'Profesional Universitario Mantenimiento  Hospitalario',
            'proceso'   => 'Mantenimiento Hospitalario',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Daniel Tibabuzo',
            'cargo'     => 'Profesional Universitario Ingeniero Biomedico',
            'proceso'   => 'Mantenimiento Biomedico',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Elizabeth Gutierrez',
            'cargo'     => 'Jefe Oficina Asesora Jurídica',
            'proceso'   => 'Gestión Jurídica y Contractual',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Yisel Hernandez Sandoval',
            'cargo'     => 'Almacenista',
            'proceso'   => 'Almacén',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Debora Murillo',
            'cargo'     => 'Jefe Oficina de Control Interno Disciplinario',
            'proceso'   => 'Control Interno Disciplinario',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);
        DB::table('users')->insert([
            'name'      => 'Andrea Rosa Rodrigez Lopez',
            'cargo'     => 'Jefe Oficina de Control Interno de Gestión',
            'proceso'   => 'Control Interno de Gestión',
            'email'     => 'jhonrymat@gmail.com',
            'password'  => bcrypt('1234'),
            'rol'       => 'servicios'
        ]);




    }
}
