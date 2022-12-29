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
    <a href="{{ route('NConformes.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i>
        Añadir
        nuevo</a>
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
    <h4>Busqueda por rango de fechas</h4>
    <div class="row">
        <div class="col-sm-3">
            <label for="">Fecha inicial : </label>
            <input type="text" class="form-control upper" name="min" id="min" value=""
                placeholder="Fecha inicial">
        </div>
        <div class="col-sm-3">
            <label for="">Fecha final : </label>
            <input type="text" class="form-control upper" name="max" id="max" value=""
                placeholder="Fecha final">
        </div>
    </div>
    <br>
    <br>
    <table id="Nconformes" class="table table-striped table-bordered shadow-lg mt-4 display compact"
        style="font-size: 13px;">
        <thead class="bg-primary text-white">
            <tr>
                <th>Codigo</th>
                <th>Fecha No Conforme</th>
                <th>Quien se queja</th>
                <th>De quien se queja</th>
                <th>Estado</th>
                <th>Acción</th>
                <th style="display: none">descripción</th>
                <th style="display: none">Acciones realizadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($NConformes as $nC)
                @if ($nC->nCproceso == auth()->user()->id && auth()->user()->rol != 'admin')
                    <tr>
                        <th>{{ $nC->id }}</th>
                        <td>{{ $nC->fReporte }}</td>
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
                                    @endswitch
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{-- <a href="{{ route('NConformes.update.vista', $nC->id) }}"
                                class="btn btn-success btn-sm mb-2" title="Editar"><i class="fas fa-edit"></i></a> --}}
                            @if ($nC->asignado == 0)
                                <a href="{{ route('tramite.create', $nC->id) }}" class="btn btn-primary btn-sm mb-2"
                                    title="Tramitar"><i class="fa fa-briefcase"></i></a>
                            @endif
                            <a data-toggle="modal" data-target="#modal-show-{{ $nC->id }}"
                                class="btn btn-warning btn-sm mb-2" title="Ver">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td style="display: none">{{ $nC->nCdescripcion }}</td>
                        <td style="display: none">{{ $nC->nCacciones }}</td>
                    </tr>
                    {{-- admin --}}
                @elseif (auth()->user()->rol == 'admin')
                    <tr>
                        <th>{{ $nC->id }}</th>
                        <td>{{ $nC->fReporte }}</td>
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
                                    @endswitch
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('NConformes.update.vista', $nC->id) }}"
                                class="btn btn-success btn-sm mb-2" title="Editar"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('tramite.create', $nC->id) }}" class="btn btn-primary btn-sm mb-2"
                                title="Tramitar"><i class="fa fa-briefcase"></i></a>
                            <a data-toggle="modal" data-target="#modal-show-{{ $nC->id }}"
                                class="btn btn-warning btn-sm mb-2" title="Ver">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td style="display: none">{{ $nC->nCdescripcion }}</td>
                        <td style="display: none">{{ $nC->nCacciones }}</td>
                    </tr>
                @endif
                {{-- modal show --}}
                <div class="modal fade" id="modal-show-{{ $nC->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Vista previa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <br>
                                <div class="card" style="width: 100%;">
                                    <div class="card-header bg-primary text-white" align="center">
                                        Datos de la no conformidad
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Id
                                            <b>{{ $nC->id }}</b>
                                        </li>
                                        <li class="list-group-item">Fecha de no conforme:
                                            <b>{{ $nC->fReporte }}</b>
                                        </li>
                                        <li class="list-group-item">Quien se queja: <b>{{ $nC->reportante }},
                                                {{ $nC->Aservicio }}</b>
                                        </li>
                                        <li class="list-group-item">De quien se queja: <b>{{ $nC->nCreportado }},
                                                {{ $nC->servicio }}</b></li>
                                        <li class="list-group-item">Descripción:
                                            <b>{{ $nC->nCdescripcion }}</b>
                                        </li>
                                        <li class="list-group-item">Acciones realizadas y fecha de realizacion:
                                            <b>{{ $nC->nCacciones }}</b>
                                        </li>
                                        <li class="list-group-item">Requiere iniciar Acción Correptiva y/o Preventiva?:
                                            <b>{{ $nC->accion }}</b>
                                        </li>
                                        <li class="list-group-item">Estado :
                                            <b>
                                                @foreach ($estado as $est)
                                                    @if ($est->id == $nC->status)
                                                        @switch($nC->status)
                                                            @case(1)
                                                                <span
                                                                    class="badge badge-pill badge-light">{{ $est->estado }}</span>
                                                            @break

                                                            @case(2)
                                                                <span
                                                                    class="badge badge-pill badge-warning">{{ $est->estado }}</span>
                                                            @break

                                                            @case(3)
                                                                <span
                                                                    class="badge badge-pill badge-primary">{{ $est->estado }}</span>
                                                            @break

                                                            @case(4)
                                                                <span
                                                                    class="badge badge-pill badge-danger">{{ $est->estado }}</span>
                                                            @break

                                                            @case(5)
                                                                <span class="badge badge-pill badge-success">Aceptado</span>
                                                            @break
                                                        @endswitch
                                                    @endif
                                                @endforeach
                                            </b>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card" style="width: 100%;">
                                    <div class="card-header bg-primary text-white" align="center">
                                        Archivos adjuntos
                                    </div>
                                    @if ($nC->imagen == 1)
                                        @foreach ($files as $file)
                                            @if ($file->noConforme == $nC->id)
                                                <ul>
                                                    {{-- <li>{{ $file->aDescripcion }}</li> --}}
                                                    <br>
                                                    @include('NConformes.IFimagenes')
                                                </ul>
                                            @endif
                                        @endforeach
                                    @else
                                        <br><br>
                                        <h6> No sé a subido archivos para este no conforme </h6>
                                    @endif
                                </div>
                                {{-- tramites --}}
                                <div class="card" style="width: 100%;">
                                    <div class="card-header text-black" align="center">
                                        <b>Tramites realizados</b>
                                    </div>
                                    <br>
                                    <div id="accordion">
                                        @forelse ($tramite as $tra)
                                            @if ($tra->nConforme == $nC->id)
                                                <div class="card">
                                                    <div class="card-header btn btn-link bg-info"
                                                        id="{{ $tra->id }}" data-toggle="collapse"
                                                        data-target="#collapseOn{{ $loop->index }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapseOn{{ $loop->index }}">
                                                        <h5 class="mb-0">
                                                            @foreach ($estado as $est)
                                                                @if ($est->id == $tra->tramite)
                                                                    {{ $est->estado }} <i class="fa fa-angle-down"
                                                                        aria-hidden="true"></i>
                                                                @endif
                                                            @endforeach
                                                        </h5>
                                                    </div>
                                                    <div id="collapseOn{{ $loop->index }}" class="collapse"
                                                        aria-labelledby="{{ $tra->id }}"
                                                        data-parent="#accordion">
                                                        <div class="card-body">
                                                            @foreach ($user as $u)
                                                                @if ($u->id == $tra->nCproceso)
                                                                    @foreach ($estado as $est)
                                                                        @if ($est->id == $tra->tramite)
                                                                            @if ($tra->tramite == 2)
                                                                                <b>Se ha asignado el no conforme a:
                                                                                    {{ $u->name }} -
                                                                                    {{ $u->cargo }} de
                                                                                    {{ $u->proceso }}</b>
                                                                            @else
                                                                                <b>{{ $u->name }} a
                                                                                    {{ $est->estado }}</b>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                            <br>
                                                            <br>
                                                            <nav>
                                                                <div class="nav nav-tabs" id="nav-tab"
                                                                    role="tablist">
                                                                    <a class="nav-item nav-link active"
                                                                        id="nav-home-tab{{ $tra->id }}"
                                                                        data-toggle="tab"
                                                                        href="#nav-home{{ $tra->id }}"
                                                                        role="tab"
                                                                        aria-controls="nav-home{{ $tra->id }}"
                                                                        aria-selected="true">Descripción</a>
                                                                    <a class="nav-item nav-link"
                                                                        id="nav-profile-tab{{ $tra->id }}"
                                                                        data-toggle="tab"
                                                                        href="#nav-profile{{ $tra->id }}"
                                                                        role="tab"
                                                                        aria-controls="nav-profile{{ $tra->id }}"
                                                                        aria-selected="false">Archivo adjunto</a>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content" id="nav-tabContent">
                                                                <div class="tab-pane fade show active"
                                                                    id="nav-home{{ $tra->id }}" role="tabpanel"
                                                                    aria-labelledby="nav-home-tab{{ $tra->id }}">
                                                                    {{ $tra->observacion }}</div>
                                                                <div class="tab-pane fade"
                                                                    id="nav-profile{{ $tra->id }}"
                                                                    role="tabpanel"
                                                                    aria-labelledby="nav-profile-tab{{ $tra->id }}">
                                                                    <div class="row">
                                                                        @forelse ($files as $file)
                                                                            @if ($file->id == $tra->tramite_img)
                                                                                <div class="col-sm-6">
                                                                                    <label
                                                                                        for="">Archivo</label>
                                                                                    <div
                                                                                        style="column-gap:0px; display:grid; grid-template-columns:60px auto; grid-template-rows:auto; padding:0rem 0; width:100%">
                                                                                        <a href="{{ asset('files/biblioteca/' . $file->ruta) }}"
                                                                                            style="grid-column: 1 / 2; grid-row: 1 / 4;"
                                                                                            title=""
                                                                                            target="_blank"
                                                                                            aria-label=""><img
                                                                                                alt=""
                                                                                                class="img-fluid mimethumb"
                                                                                                src="{{ asset('img/' . 'logo-archivo.webp') }}"
                                                                                                style="height:auto; max-width:50%"
                                                                                                title=""> </a>
                                                                                        <a href="{{ asset('files/biblioteca/' . $file->ruta) }}"
                                                                                            target="_blank"><span
                                                                                                style="font-size:12px"><span
                                                                                                    style="font-family:Arial,Helvetica,sans-serif"><span
                                                                                                        style="color:#000000">{{ $file->nombre }}
                                                                                                    </span></span></span></a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <label for="">Descripción
                                                                                        del
                                                                                        archivo</label>
                                                                                    <div>
                                                                                        {{ $file->aDescripcion }}
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @empty
                                                                            <p>No hay archivos para esta respuesta</p>
                                                                        @endforelse

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @empty
                                            {{-- no hay nada que mostrar --}}
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                    buttons: [
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'Exportar a PDF',
                            title: 'No conformes',
                            className: 'btn btn-outline-danger',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4] //exportar solo la primera y segunda columna
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
                                columns: [1, 2, 3, 4] //exportar solo la primera y segunda columna
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
                            extend:'excelHtml5',
                            text:'<i class="fas fa-file-excel"></i>',
                            className: 'btn btn-outline-success',
                            titleAttr: 'Exportar a Excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 6, 7] //exportar solo la primera y segunda columna
                            },
                            excelStyles:{
                                "template":[
                                    "blue_medium", "header_blue","title_medium"
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
