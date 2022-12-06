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
    @if ($NConforme->id ?? null)
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
                                    <li class="list-group-item">Codigo:
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
                                    <li class="list-group-item">Estado :
                                        <b>
                                            @foreach ($estado as $est)
                                                @if ($est->id == $NConforme->status)
                                                    @switch($NConforme->status)
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
                                        </b>
                                    </li>
                                </ul>
                            </div>

                            <div class="card" style="width: 100%;">
                                <div class="card-header bg-primary text-white" align="center">
                                    Archivos adjuntos
                                </div>
                                @if ($NConforme->imagen == 1)
                                    @forelse ($files as $file)
                                        @if ($file->noConforme == $NConforme->id)
                                            <ul>
                                                {{-- <li>{{ $file->aDescripcion }}</li> --}}
                                                <br>
                                                @include('NConformes.IFimagenes')
                                            </ul>
                                        @endif
                                    @empty
                                        <p>No hay archivos para esta respuesta</p>
                                    @endforelse
                                @else
                                    <br>
                                    <h6 align="center"> No sé a subido archivos para este no conforme </h6>
                                @endif
                            </div>
                            {{-- ejemplo --}}
                            <div class="card" style="width: 100%;">
                                <div class="card-header text-black" align="center">
                                    <b>Tramites realizados</b>
                                </div>
                                <br>
                                <div id="accordion">
                                    @forelse ($tramite as $tra)
                                        @if ($tra->nConforme == $NConforme->id)
                                            <div class="card">
                                                <div class="card-header btn btn-link bg-info" id="{{ $tra->id }}"
                                                    data-toggle="collapse" data-target="#collapseOn{{ $loop->index }}"
                                                    aria-expanded="true" aria-controls="collapseOn{{ $loop->index }}">
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
                                                    aria-labelledby="{{ $tra->id }}" data-parent="#accordion">
                                                    <div class="card-body">

                                                        @foreach ($user as $u)
                                                            @if ($u->id == $tra->nCproceso)
                                                                @foreach ($estado as $est)
                                                                    @if ($est->id == $tra->tramite)
                                                                        <b>{{ $u->name }} a {{ $est->estado }}</b>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                        <br>
                                                        <br>
                                                        <nav>
                                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <a class="nav-item nav-link active"
                                                                    id="nav-home-tab{{ $tra->id }}" data-toggle="tab"
                                                                    href="#nav-home{{ $tra->id }}" role="tab"
                                                                    aria-controls="nav-home{{ $tra->id }}"
                                                                    aria-selected="true">Descripción</a>
                                                                <a class="nav-item nav-link"
                                                                    id="nav-profile-tab{{ $tra->id }}"
                                                                    data-toggle="tab"
                                                                    href="#nav-profile{{ $tra->id }}" role="tab"
                                                                    aria-controls="nav-profile{{ $tra->id }}"
                                                                    aria-selected="false">Archivo adjunto</a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" id="nav-tabContent">
                                                            <div class="tab-pane fade show active"
                                                                id="nav-home{{ $tra->id }}" role="tabpanel"
                                                                aria-labelledby="nav-home-tab{{ $tra->id }}">
                                                                {{ $tra->observacion }}</div>
                                                            <div class="tab-pane fade" id="nav-profile{{ $tra->id }}"
                                                                role="tabpanel"
                                                                aria-labelledby="nav-profile-tab{{ $tra->id }}">
                                                                <div class="row">
                                                                    @forelse ($files as $file)
                                                                        @if ($file->id == $tra->tramite_img)
                                                                            <div class="col-sm-6">
                                                                                <label for="">Archivo</label>
                                                                                <div
                                                                                    style="column-gap:0px; display:grid; grid-template-columns:60px auto; grid-template-rows:auto; padding:0rem 0; width:100%">
                                                                                    <a href="{{ asset('files/biblioteca/' . $file->ruta) }}"
                                                                                        style="grid-column: 1 / 2; grid-row: 1 / 4;"
                                                                                        title="" target="_blank"
                                                                                        aria-label=""><img alt=""
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

                    </div>
                </div>

                <a class="btn btn-danger float-left" href="{{ url('NConformes/lista') }}">Atras</a>
                <br>
                <br>
            </div>
        </div>
    @else
    <script type="text/javascript">
        function redirect() {
            window.location.href = "<?php echo URL::to('NConformes/index'); ?>";
        }
        window.onload = redirect;
    </script>
    @endif
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
