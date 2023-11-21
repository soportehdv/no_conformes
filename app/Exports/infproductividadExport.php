<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Files;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Estados;
use App\Models\Tramite;
use App\Models\NConforme;
use App\Models\NconformeR;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class infproductividadExport implements FromCollection,WithHeadings
{

    public function headings(): array
    {
        return [
            'CODIGO',
            'RADICADO',
            'MES',
            'FECHA_NO_CONFORME',
            'QUIEN_SE_QUEJA',
            'ESTADO',
            'DESCRIPCION',
            'ACCIONES_REALIZADAS',
            'FECHA_DE_CIERRE_CALIDAD',
            'DIAS',
            'FECHA_RESPUETAS',
            'RESPUESTAS',
            'TIEMPO_TRASNCURRIDO',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $respueatas =  DB::table('nconformes')
       ->select('nconformes.id', 'nconformes.radicado', 'nconformes.created_at', 'users.cargo', 'estados.estado', 'nconformes.nCdescripcion', 'nconformes.nCacciones',
        'nconformes.NcFinalizado',
        DB::raw('datediff(nconformes.NcFinalizado , nconformes.created_at)'),//,
        'tramites.created_at AS FEC','tramites.observacion',
        DB::raw('datediff(tramites.created_at, nconformes.created_at)'))
       ->join('users','nconformes.proceso','=','users.id')
       ->join('estados','nconformes.status','=','estados.id')
       ->join('tramites','nconformes.id','=','tramites.nConforme')
       //->where('nconformes.id','=',100)
       ->get();

       return $respueatas;

    }
}
