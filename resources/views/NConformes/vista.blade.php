@extends('adminlte::page')
@section('title', 'Editar No Conforme')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>No Conforme</h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        {{-- <br> --}}
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
        <br>
        @csrf
        <div class="form-group">
            <div class="card">
                <div class="card-header bg-primary">
                    INFORMACION DEL NO CONFORME
                </div>
                <div class="card-body">

                    <div class="modal-body">
                        <br>
                        <div class="card" style="width: 100%;">
                            <div class="card-header bg-primary text-white" align="center">
                                Datos de la no conformidad
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Id
                                    <b>{{ $NConforme->id }}</b>
                                </li>
                                <li class="list-group-item">Fecha de no conforme:
                                    <b>{{ $NConforme->fReporte }}</b>
                                </li>
                                @foreach ($user as $us1)
                                    @if ($us1->id == $NConforme->proceso)
                                        <li class="list-group-item">Quien se queja: <b>{{ $us1->name }},
                                                {{ $us1->proceso }}</b>
                                        </li>
                                    @endif
                                @endforeach

                                @foreach ($user2 as $us2)
                                    @if ($us2->id == $NConforme->nCproceso)
                                        <li class="list-group-item">De quien se queja: <b>{{ $us2->name }},
                                                {{ $us2->proceso }}</b>
                                        </li>
                                    @endif
                                @endforeach
                                <li class="list-group-item">Descripción:
                                    <b>{{ $NConforme->nCdescripcion }}</b>
                                </li>
                                <li class="list-group-item">Acciones realizadas y fecha de realizacion:
                                    <b>{{ $NConforme->nCacciones }}</b>
                                </li>
                                <li class="list-group-item">Requiere iniciar Acción Correptiva y/o Preventiva?:
                                    <b>{{ $NConforme->accion }}</b>
                                </li>
                                @if ($NConforme->status == 'registrada')
                                    <li class="list-group-item">Estado :
                                        <b>{{ $NConforme->status }}</b>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="card" style="width: 100%;">
                            <div class="card-header bg-primary text-white" align="center">
                                Archivos adjuntos
                            </div>
                            @if ($NConforme->imagen == 1)
                                @foreach ($files as $file)
                                    @if ($file->noConforme == $NConforme->id)
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
                        {{-- ejemplo --}}


                    </div>

                </div>
            </div>

            <a class="btn btn-danger float-left" href="{{ URL::previous() }}">Atras</a>
            <br>
            <br>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
