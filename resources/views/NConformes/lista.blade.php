@extends('adminlte::page')
@section('title', 'No Conformes')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>No Conformes</h2>
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
                <th>Fecha No Conforme</th>
                <th>Quien se queja</th>
                <th>De quien se queja</th>
                <th>Estado</th>
                <th>Acción</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($NConformes as $nC)
                <tr>
                    <th>{{ $nC->id }}</th>
                    <td>{{ $nC->fReporte }}</td>
                    <td>{{ $nC->reportante }}, {{ $nC->Aservicio }}</td>
                    <td>{{ $nC->nCreportado }}, {{ $nC->servicio }}</td>
                    <td>{{ $nC->status }}</td>
                    <td><a href="{{ route('NConformes.update.vista', $nC->id) }}" class="btn btn-success btn-sm mb-2"><i
                                class="fas fa-edit"></i></a>
                        <a data-toggle="modal" data-target="#modal-show-{{ $nC->id }}"
                            class="btn btn-warning btn-sm mb-2">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>

                </tr>
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
                                            <b>{{ $nC->id  }}</b>
                                        </li>
                                        <li class="list-group-item">Fecha de no conforme:
                                            <b>{{ $nC->fReporte }}</b>
                                        </li>
                                        <li class="list-group-item">Quien se queja: <b>{{ $nC->reportante }}, {{ $nC->Aservicio }}</b>
                                        </li>
                                        <li class="list-group-item">De quien se queja: <b>{{ $nC->nCreportado }}, {{ $nC->servicio }}</b></li>
                                        <li class="list-group-item">Descripción:
                                            <b>{{ $nC->aDescripcion }}</b>
                                        </li>
                                        <li class="list-group-item">Acciones realizadas y fecha de realizacion: <b>{{ $nC->nCacciones }}</b></li>
                                        <li class="list-group-item">Requiere iniciar Acción Correptiva y/o Preventiva?:
                                            <b>{{ $nC->accion }}</b>
                                        </li>
                                        @if ($nC->status == "registrada")
                                            <li class="list-group-item">Estado :
                                                <b>{{ $nC->status }}</b>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                {{-- @if ($documento->name != null)
                                    <div class="bajardoc">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a href="{{ asset('files/biblioteca/' . $documento->ruta) }}"
                                                        title="{{ $documento->nombre }} ({{ $documento->updated_at }})."
                                                        target="blank">
                                                        <img src="http://www.hdv.gov.co/files/biblioteca/2022-09-27_7271042.png"
                                                            alt="{{ $documento->nombre }} ({{ $documento->updated_at }})."
                                                            title="{{ $documento->nombre }} ({{ $documento->updated_at }})."
                                                            width="100" height="100"
                                                            class="mimethumb img-fluid">
                                                    </a>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <a href="{{ asset('files/biblioteca/' . $documento->ruta) }}"
                                                            title="{{ $documento->nombre }}."
                                                            target="blank">{{ $documento->nombre }}.</a>
                                                    </div>
                                                    <div class="row">
                                                        <a class="descarga"
                                                            href="{{ asset('documentos/download/' . $documento->id) }}">{{ $documento->size }}
                                                            KB, Descargar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if ($documento->name_edit != null && $documento->extension_edit == 'doc')
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <a href="{{ asset('files/biblioteca/' . $documento->ruta_edit) }}"
                                                            title="{{ $documento->nombre }}." target="blank">
                                                            <img src="http://www.hdv.gov.co/files/biblioteca/2022-09-27_337932.png"
                                                                alt="{{ $documento->nombre }}."
                                                                title="{{ $documento->nombre }}." width="100"
                                                                height="100" class="mimethumb img-fluid">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <a href="{{ asset('files/biblioteca/' . $documento->ruta_edit) }}"
                                                                title="{{ $documento->nombre }}."
                                                                target="blank">{{ $documento->nombre }}.</a>
                                                        </div>
                                                        <div class="row">
                                                            <a class="descarga"
                                                                href="{{ asset('documentos/download/' . $documento->id) }}">{{ $documento->size_edit }}
                                                                KB, Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($documento->name_edit != null)
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <a href="{{ asset('files/biblioteca/' . $documento->ruta_edit) }}"
                                                            title="{{ $documento->nombre }}." target="blank">
                                                            <img src="https://www.hdv.gov.co/files/biblioteca/2022-09-27_337958.png"
                                                                alt="{{ $documento->nombre }}."
                                                                title="{{ $documento->nombre }}." width="100"
                                                                height="100" class="mimethumb img-fluid">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <a href="{{ asset('files/biblioteca/' . $documento->ruta_edit) }}"
                                                                title="{{ $documento->nombre }}."
                                                                target="blank">{{ $documento->nombre }}.</a>
                                                        </div>
                                                        <div class="row">
                                                            <a class="descarga"
                                                                href="{{ asset('documentos/download/' . $documento->id) }}">{{ $documento->size_edit }}
                                                                KB, Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <br><br>
                                                <h6> No sé a subido archivos editables para este documento </h6>
                                            @endif
                                        </div>
                                    </div>
                                    <h5 align="center"><b>Previsualización</b></h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div align="center">
                                                @if ($documento->mime == 'image')
                                                    <img src="{{ asset('files/biblioteca/' . $documento->ruta) }}"
                                                        height="200px" width="300px" alt="imagenes">
                                                @endif
                                                @if ($documento->extension == 'pdf')
                                                    <embed src="{{ asset('files/biblioteca/' . $documento->ruta) }}"
                                                        type="application/pdf" width="100%" height="600px" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <br><br>
                                    <h6> No sé a subido archivos para este documento </h6>
                                @endif --}}

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
                            0: 'Selecione un opción para filtrar tu busqueda',
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
