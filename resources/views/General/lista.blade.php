@extends('adminlte::page')
@if (auth()->user()->rol == 'admin')
    @section('title', 'No Conformes generales')

    @section('content_header')
        <div class="card" style="height:4em;">
            <div class="card-header">
                <h2>No Conformes generales</h2>
            </div>

        </div>
    @else
    @section('title', 'No Conformes Recibidos')

    @section('content_header')
        <div class="card" style="height:4em;">
            <div class="card-header">
                <h2>No Conformes Recibidos</h2>
            </div>

        </div>
    @endif

@section('cssDataTable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@endsection

@section('content')



<div class="container">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <br>
            <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
    <br>
    <br>
    <table id="Nconformes" class="table table-striped table-bordered shadow-lg mt-4 display compact"
        style="font-size: 13px;">
        <thead class="bg-primary text-white">
            <tr>
                <th>Codigo</th>
                <th>Radicado</th>
                <th>Fecha No Conforme</th>
                <th>Quien se queja</th>
                <th>De quien se queja</th>
                <th>Estado</th>
                <th>Acción</th>
                <th style="display: none">descripción</th>
                <th style="display: none">Acciones realizadas</th>
                <th style="display: none">Fecha de finalizacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($NConformes as $nC)
                @if ($nC->proceso == auth()->user()->id && auth()->user()->rol != 'admin')
                    <tr>
                        <th>{{ $nC->id }}</th>
                        <th>{{ $nC->radicado }}</th>
                        <td>
                            @php
                                //suma 5 dias a la fecha ingresada
                                $fechaSinH = \Carbon\Carbon::parse($nC->fReporte)
                                    ->addDay(6)
                                    ->toDateTimeString();

                                // obteniendo fecha fin hora
                                $r = \Carbon\Carbon::parse($fechaSinH)->format('Y/m/d');

                                // comparacion de fechas para saber cuantos dias quedan
                                $restantes = \Carbon\Carbon::createFromTimeStamp(strtotime($r))->diffInDays(now(), false);
                            @endphp
                            @if ($nC->status == '5')
                                <b>{{ $nC->fReporte }}</b>
                            @else
                                @if ($restantes >= 0)
                                    <b>{{ $nC->fReporte }} <span class="badge badge-pill badge-danger">En mora</span></b>
                                @else
                                    <b>{{ $nC->fReporte }} <span class="badge badge-pill badge-danger">Faltan
                                            {{ $restantes }}-</span> dias</b>
                                @endif
                            @endif
                        </td>
                        <td>{{ $nC->Aservicio }}</td>
                        <td>{{ $nC->servicio }}</td>
                        <td>
                            @foreach ($estado as $est)
                                @if ($est->id == $nC->status)
                                    @switch($nC->status)
                                        @case(1)
                                            <span class="badge badge-pill badge-light">{{ $est->estado }}</span>
                                        @break

                                        @case(2)
                                            <span class="badge badge-pill badge-warning">{{ $est->estado }}</span>
                                        @break

                                        @case(3)
                                            <span class="badge badge-pill badge-primary">{{ $est->estado }}</span>
                                        @break

                                        @case(4)
                                            <span class="badge badge-pill badge-danger">{{ $est->estado }}</span>
                                        @break

                                        @case(5)
                                            <span class="badge badge-pill badge-success">Aceptado</span>
                                        @break

                                        @case(6)
                                            <span class="badge badge-pill badge-danger">{{ $est->estado }}</span>
                                        @break

                                        @case(7)
                                            <span class="badge badge-pill badge-danger">{{ $est->estado }}</span>
                                        @break

                                        @case(8)
                                            <span class="badge badge-pill badge-danger">{{ $est->estado }}</span>
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('NConformesGeneral.update.vista', $nC->id) }}"
                                class="btn btn-success btn-sm mb-2" title="Editar"><i class="fas fa-edit"></i></a>
                        </td>
                        <td style="display: none">{{ $nC->nCdescripcion }}</td>
                        <td style="display: none">{{ $nC->nCacciones }}</td>
                        <td style="display: none">{{ $nC->NcFinalizado }}</td>
                    </tr>
                    {{-- admin --}}
                @elseif (auth()->user()->rol == 'admin')
                    <tr>
                        <th>{{ $nC->id }}</th>
                        <th>{{ $nC->radicado }}</th>
                        <td>
                            {{ $nC->fReporte }}
                            @php
                                //suma 5 dias a la fecha ingresada
                                $fechaSinH = \Carbon\Carbon::parse($nC->fReporte)
                                    ->addDay(6)
                                    ->toDateTimeString();

                                // obteniendo fecha fin hora
                                $r = \Carbon\Carbon::parse($fechaSinH)->format('Y/m/d');

                                // comparacion de fechas para saber cuantos dias quedan
                                $restantes = \Carbon\Carbon::createFromTimeStamp(strtotime($r))->diffInDays(now(), false);
                            @endphp
                            @if ($nC->status == '5')
                                <b><span class="badge badge-pill badge-primary"
                                        style="font-size: 12px">Finalizada</span></b>
                            @else
                                @if ($restantes >= 0)
                                    <b><span class="badge badge-pill badge-danger">En mora</span></b>
                                @else
                                <b><span class="badge badge-pill badge-danger">Faltan
                                    {{ $restantes }}-</span> dias</b>
                                @endif
                            @endif
                        </td>
                        <td>{{ $nC->Aservicio }}</td>
                        <td>{{ $nC->servicio }}</td>
                        <td>
                            @foreach ($estado as $est)
                                @if ($est->id == $nC->status)
                                    @switch($nC->status)
                                        @case(1)
                                            <span class="badge badge-pill badge-light">{{ $est->estado }}</span>
                                        @break

                                        @case(2)
                                            <span class="badge badge-pill badge-warning">{{ $est->estado }}</span>
                                        @break

                                        @case(3)
                                            <span class="badge badge-pill badge-primary">{{ $est->estado }}</span>
                                        @break

                                        @case(4)
                                            <span class="badge badge-pill badge-danger">{{ $est->estado }}</span>
                                        @break

                                        @case(5)
                                            <span class="badge badge-pill badge-success">Aceptado</span>
                                        @break

                                        @case(6)
                                            <span class="badge badge-pill badge-warning">{{ $est->estado }}</span>
                                        @break

                                        @case(7)
                                            <span class="badge badge-pill badge-success">{{ $est->estado }}</span>
                                        @break

                                        @case(8)
                                            <span class="badge badge-pill badge-danger">{{ $est->estado }}</span>
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('NConformesGeneral.update.vista', $nC->id) }}"
                                class="btn btn-success btn-sm mb-2" title="Editar"><i class="fas fa-edit"></i></a>
                        </td>
                        <td style="display: none">{{ $nC->nCdescripcion }}</td>
                        <td style="display: none">{{ $nC->nCacciones }}</td>
                        <td style="display: none">{{ $nC->NcFinalizado }}</td>
                    </tr>
                @endif
            @endforeach


        </tbody>
    </table>

</div>

@section('jsDataTable')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    {{-- usar excel --}}
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js">
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js">
    </script>




    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[1]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'

            });

            var table = $('#Nconformes').DataTable({
                dom: 'Bfrtip',
                buttons: {
                    dom: {
                        button: {
                            className: 'btn',
                        },
                    },
                    buttons: [{
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'Exportar a PDF',
                            title: 'No conformes',
                            className: 'btn btn-outline-danger',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5] //exportar solo la primera y segunda columna
                            },
                            customize: function(doc) {
                                doc.styles.tableBodyEven.alignment = 'center';
                                doc.styles.tableBodyOdd.alignment = 'center';
                            },
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i>',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-outline-info',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5] //exportar solo la primera y segunda columna
                            },
                            customize: function(win) {

                                $(win.document.body)
                                    .css('font-size', '10pt')
                                    .prepend(
                                        '<img src="https://www.hdv.gov.co/files/biblioteca/2022-12-14_logoHDV1.png" style="position:absolute; top:30%; left:5%; width:700px; opacity: 0.3;" />'
                                    );

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit')
                                    .css('width', '780px')
                                    .css('text-align', 'center');

                                $(win.document.body).find('table, th')
                                    .css('text-align', 'center');

                                $(win.document.body).find('table, th')
                                    .css('text-align', 'center');
                            },
                            header: true,
                            title: 'No conformes',
                            orientation: 'landscape',
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            className: 'btn btn-outline-success',
                            titleAttr: 'Exportar a Excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 7,
                                    8, 9
                                ] //exportar solo la primera y segunda columna
                            },
                            excelStyles: {
                                "template": [
                                    "blue_medium", "header_blue", "title_medium"
                                ]
                            }
                        },
                    ]

                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    "datetime": {
                        "previous": "Anterior",
                        "next": "Proximo",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "AM",
                            "PM"
                        ],
                        "months": {
                            "0": "Enero",
                            "1": "Febrero",
                            "10": "Noviembre",
                            "11": "Diciembre",
                            "2": "Marzo",
                            "3": "Abril",
                            "4": "Mayo",
                            "5": "Junio",
                            "6": "Julio",
                            "7": "Agosto",
                            "8": "Septiembre",
                            "9": "Octubre"
                        },
                        "weekdays": [
                            "Dom",
                            "Lun",
                            "Mar",
                            "Mie",
                            "Jue",
                            "Vie",
                            "Sab"
                        ]
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "collection": "Colección",
                        "colvisRestore": "Restaurar visibilidad",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %ds fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir",
                        "renameState": "Cambiar nombre",
                        "updateState": "Actualizar",
                        "createState": "Crear Estado",
                        "removeAllStates": "Remover Estados",
                        "removeState": "Remover",
                        "savedStates": "Estados Guardados",
                        "stateRestore": "Estado %d"
                    },
                }

            });

            $('#min, #max').on('change', function() {
                table.draw();

            });
        });
    </script>
@endsection

@endsection
