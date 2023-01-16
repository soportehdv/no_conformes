@extends('adminlte::page')
@section('title', 'Editar No Conforme')

@section('content_header')
    <script>
        function checkSubmit() {
            document.getElementById("btsubmit").value = "Enviando...";
            document.getElementById("btsubmit").disabled = true;
            return true;
        }
    </script>
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Confimación de No Conforme</h2>
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
        <form method="POST" action="{{ route('NConformes.create') }}" enctype="multipart/form-data" onsubmit="return checkSubmit();">
            @csrf
            <div class="form-group">
                <div class="card">
                    <div class="card-header bg-primary">
                        INFORMACION DEL REPORTANTE
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Reportado por : </label>
                                <input type="text" class="form-control upper" name="reportado" id="reportado"
                                    value="{{ $NConforme->reportado }}" placeholder="Nombre del reportante">
                            </div>
                            <div class="col-sm-6">
                                <label for="exampleInputEmail1">Fecha de reporte : </label>
                                <input type="datetime-local" autocomplete="on" class="form-control upper" name="fReporte"
                                    id="fReporte" value="{{ $NConforme->fReporte }}" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Proceso : </label>
                                <select class="form-control" name="proceso" id="proceso" required>
                                    @foreach ($user as $us)
                                        @if (Auth::user()->id == $us->id)
                                            <option value="{{ $us->id }}">
                                                {{ $us->cargo }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Coordinador : </label>
                                @foreach ($user as $us)
                                    @if ($us->id == $NConforme->proceso)
                                        <input type="text" class="form-control upper" id="reportante" name="reportante"
                                            value="{{ $us->name }}" disabled>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-sm-4">
                                <label for="">Correo : </label>
                                @foreach ($user as $us)
                                    @if ($us->id == $NConforme->proceso)
                                        <input type="text" class="form-control upper" id="correo" name="correo"
                                            value="{{ $us->email }}" disabled>
                                        <input type="hidden" name="correoOculto" id="correoOculto"
                                            value="{{ $us->email }}">
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        INFORMACION DE NO CONFORMIDAD
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Proceso : </label>
                                <select class="form-control" name="nCproceso" id="nCproceso" required>
                                    <option value="">Seleciona un proceso</option>
                                    @foreach ($user as $us)
                                        @if ($loop->index != 0)
                                            <option value="{{ $us->id }}"
                                                @if ($NConforme->nCproceso == $us->id) selected='selected' @endif>
                                                {{ $us->cargo }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Coordinador : </label>
                                @foreach ($user as $us)
                                    @if ($us->id == $NConforme->nCproceso)
                                        <input type="text" class="form-control upper" id="nCreportado" name="nCreportado"
                                            value="{{ $us->name }}" disabled>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-sm-4">
                                <label for="">Correo : </label>
                                @foreach ($user as $us)
                                    @if ($us->id == $NConforme->nCproceso)
                                        <input type="text" class="form-control upper" id="correoR" name="correoR"
                                            value="{{ $us->email }}" disabled>
                                        <input type="hidden" name="correoOculto2" id="correoOculto2"
                                            value="{{ $us->email }}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Descripción del servicio no conforme : </label>
                                <textarea type="textarea" class="form-control upper" name="nCdescripcion" id="nCdescripcion" value=""
                                    placeholder="Describa lo sucedido">{{ $NConforme->nCdescripcion }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Acciones realizadas y fecha de realización : </label>
                                <textarea type="textarea" class="form-control upper" name="nCacciones" id="nCacciones" value=""
                                    placeholder="(Corrección inicial efectuada)">{{ $NConforme->nCacciones }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        INFORMACION ADICIONAL
                    </div>
                    <div class="card-body">
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">¿Requiere iniciar Acción Correctiva y/o Preventiva?</label>
                                <br>
                                @if ($NConforme->accion === 'no')
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="accion" id="no" class="custom-control-input"
                                            value="no" checked>
                                        <label for="no" class="custom-control-label">No </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="accion" id="si" class="custom-control-input"
                                            value="si">
                                        <label for="si" class="custom-control-label">Si </label>
                                    </div>
                                @else
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="accion" id="no" class="custom-control-input"
                                            value="no">
                                        <label for="no" class="custom-control-label">No </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="accion" id="si" class="custom-control-input"
                                            value="si" checked>
                                        <label for="si" class="custom-control-label">Si </label>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 center_margin">
                                <div class="card" style="width: 100%;">
                                    <div class="card-header bg-primary text-white" align="center">
                                        Archivos adjuntos
                                    </div>
                                    <input type="hidden" name="idNc" id="idNc" value="{{ $NConforme->id }}">
                                    @if ($NConforme->imagen == 1)
                                        {{-- enviando información que existe imagen --}}
                                        <input type="hidden" name="ExisteImg" id="ExisteImg"
                                            value="{{ $NConforme->id }}">
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
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        ACEPTACION O RECHAZO DE SOLICITUD
                    </div>
                    <div class="card-body">
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Cambiar Estado : </label>
                                <select class="form-control" name="estadoAr" id="estadoAr" required>
                                    <option value="">Selecione una opción</option>
                                    <option value="7">Aprobar</option>
                                    <option value="8">Rechazar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($NConforme->status == '7' || $NConforme->status == '8')
                    <input class="btn btn-success float-right" value="Enviar" type="submit" disabled>
                @else
                    <input class="btn btn-success float-right" value="Enviar" type="submit" id="btsubmit"
                        name="btsubmit">
                @endif

                <a class="btn btn-danger float-left" href="{{ URL::previous() }}">Atras</a>
                <br>
                <br>
            </div>
        </form>

    </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    $(document).on('change', '#proceso', (e) => {
        fetch('../subcategorias', {
            method: 'POST',
            body: JSON.stringify({
                texto: e.target.value

            }),
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": document.querySelector(
                    'meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            return response.json()
        }).then(data => {
            for (let i in data.lista) {
                var opciones = data.lista[i].name;
                var opciones2 = data.lista[i].email;

            }
            $('#reportante').val(opciones);
            $('#correo').val(opciones2);
            $('#correoOculto').val(opciones2);

        }).catch(error => console.error(error));
    });

    $(document).on('change', '#nCproceso', (e) => {
        fetch('../subcategorias', {
            method: 'POST',
            body: JSON.stringify({
                texto: e.target.value

            }),
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": document.querySelector(
                    'meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            return response.json()
        }).then(data => {
            for (let i in data.lista) {
                var opciones = data.lista[i].name;
                var opciones2 = data.lista[i].email;
            }
            $('#nCreportado').val(opciones);
            $('#correoR').val(opciones2);
            $('#correoOculto2').val(opciones2);

        }).catch(error => console.error(error));
    });
</script>
