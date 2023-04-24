@extends('adminlte::page')
@section('title', 'No Conformes Enviados')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>No Conformes Enviados</h2>
        </div>

    </div>
@section('cssDataTable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
@endsection

@endsection

@section('content')



<div class="container">
    <a href="{{ route('NConformes.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir
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
    <table id="Nconformes" class="table table-striped table-bordered shadow-lg mt-4 display compact"
        style="font-size: 16px;">
        <thead class="bg-primary text-white">
            <tr>
                <th>Codigo</th>
                <th>Radicado</th>
                <th>Fecha No Conforme</th>
                <th>Quien se queja</th>
                <th>De quien se queja</th>
                <th>Estado</th>
                <th>Acción</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($NConformes as $nC)
                @if ($nC->proceso == auth()->user()->id)
                    <tr>
                        <th>{{ $nC->id }}</th>
                        <th>{{ $nC->radicado }}</th>
                        <td>{{ $nC->fReporte }}</td>
                        <td>{{ $nC->Aservicio }}</td>
                        <td>{{ $nC->servicio }}</td>
                        <td>
                            @foreach ($estados as $est)
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
                                class="btn btn-success btn-sm mb-2"><i class="fas fa-edit"></i></a> --}}
                            <a data-toggle="modal" data-target="#modal-show-{{ $nC->id }}"
                                class="btn btn-warning btn-sm mb-2">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
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
                                        <li class="list-group-item">radicado
                                            <b>{{ $nC->radicado }}</b>
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
                                        <li class="list-group-item">Requiere iniciar Acción Correctiva y/o Preventiva?:
                                            <b>{{ $nC->accion }}</b>
                                        </li>
                                        <li class="list-group-item">Estado :
                                            <b>
                                                @foreach ($estados as $est)
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
                                        <h6> No se han subido archivos para este no conforme </h6>
                                    @endif
                                </div>
                                {{-- tramites --}}
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
                                                            @foreach ($estados as $est)
                                                                @if ($est->id == $tra->tramite)
                                                                    {{ $est->estado }} <i class="fa fa-angle-down"
                                                                        aria-hidden="true"></i>
                                                                @endif
                                                            @endforeach
                                                        </h5>
                                                    </div>
                                                    <div id="collapseOn{{ $loop->index }}" class="collapse"
                                                        aria-labelledby="{{ $tra->id }}" data-parent="#accordion">
                                                        <div class="card-body">
                                                            @foreach ($user as $u)
                                                                @if ($u->id == $tra->nCproceso)
                                                                    @foreach ($estados as $est)
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
                                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
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
    <script>
        $(document).ready(function() {
            $('#Nconformes').DataTable({
                "language": {
                    searchPanes: {
                        title: {
                            _: 'Total de filtros selecionados - %d',
                            0: 'Seleccione un opción para filtrar tu busqueda',
                            1: 'Se ha selecionado un filtro'
                        },
                        "clearMessage": "Borrar seleccionados",
                        "showMessage": "Mostrar Todo",
                        "collapseMessage": "Contraer Todo",
                        count: '{total}',
                        countFiltered: '{shown} ({total})',
                    },
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se ha encontrado nada relacionado - Disculpa",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "print": "Imprimir",
                    }
                }
            });
        });
    </script>
@endsection

@endsection
