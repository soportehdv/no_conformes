@extends('adminlte::page')
@section('title', 'Crear No Conforme')

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
            <h2>Crear No Conforme</h2>
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
        <form method="POST" action="{{ route('NConformesGeneral.create') }}" enctype="multipart/form-data"
            onsubmit="return checkSubmit();">
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
                                    value="" placeholder="Nombre del reportante">
                            </div>
                            <div class="col-sm-6">
                                <label for="exampleInputEmail1">Fecha de reporte : </label>
                                <input type="datetime-local" autocomplete="on" class="form-control upper" name="fReporte"
                                    id="fReporte" value="" aria-describedby="emailHelp" required>
                            </div>
                            {{-- <input type="hidden" name="user" id="user" value="jhonrymat@gmail.com"> --}}
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Proceso : </label>
                                <select class="form-control" name="proceso" id="proceso" required>
                                    <option value="">Seleciona un proceso</option>
                                    @foreach ($subProceso as $us)
                                        @if ($us->id >= 3 && $us->id != 52)
                                            <option value="{{ $us->id }}">
                                                {{ $us->cargo }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Coordinador : </label>
                                <input type="text" class="form-control upper" id="reportante" name="reportante"
                                    value="" disabled>

                            </div>
                            <div class="col-sm-4">
                                <label for="">Correo : </label>
                                <input type="text" class="form-control upper" id="correo" name="correo"
                                    value="" disabled>
                                <input type="hidden" name="correoOculto" id="correoOculto" value="">
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
                                    @foreach ($subProceso as $sp)
                                        @if ($sp->id >= 3 && $sp->id != 52)
                                            <option value="{{ $sp->id }}">
                                                {{ $sp->cargo }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Responsable : </label>
                                <input type="text" class="form-control upper" name="nCreportado" id="nCreportado"
                                    value="" placeholder="Responsable" disabled>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Correo : </label>
                                <input type="text" class="form-control upper" name="correoR" id="correoR"
                                    value="" placeholder="Correo" disabled>
                                <input type="hidden" name="correoOculto2" id="correoOculto2" value="">

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Descripción del servicio no conforme : </label>
                                <textarea type="textarea" class="form-control upper" name="nCdescripcion" id="nCdescripcion" value=""
                                    placeholder="Describa lo sucedido"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Acciones realizadas y fecha de realización : </label>
                                <textarea type="textarea" class="form-control upper" name="nCacciones" id="nCacciones" value=""
                                    placeholder="(Corrección inicial efectuada)"></textarea>
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
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="accion" id="si" class="custom-control-input"
                                        value="si">
                                    <label for="si" class="custom-control-label">Si </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="accion" id="no" class="custom-control-input"
                                        value="no">
                                    <label for="no" class="custom-control-label">No </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6 center_margin">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">¿Desea adjuntar archivos?</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Breve descripción del archivo adjunto : </label>
                                <textarea type="textarea" class="form-control upper" name="aDescripcion" id="aDescripcion" value=""
                                    placeholder="Descripción corta"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <input class="btn btn-success float-right" type="submit" value="Ingresar" /> --}}
                <input class="btn btn-success float-right" value="Enviar" type="submit" id="btsubmit"
                    name="btsubmit">
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
        fetch('subcategorias', {
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
        fetch('subcategorias', {
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
