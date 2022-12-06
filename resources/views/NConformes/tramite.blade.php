@extends('adminlte::page')
@section('title', 'Tramite')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Tramite de no conforme</h2>
        </div>

    </div>

@endsection

@section('content')

    <div class="container">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <li>{{ $error }}</li>
                    </div>
                @endforeach
            </ul>
        @endif

        <div class="row">
            <div class="col-md-8" style="float: none; margin:auto;">
                <p>Aqui podra responder las no conformidades asignadas. </p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10" style="float: none; margin:auto; ">
                <p>
                    <n>Seleccioné el tipo de Tramite para continuar:</n>
                </p>
                <select class="form-control" id="status" name="status" onChange="mostrar(this.value);">
                    <option value="ninguno">Seleccione un tramite</option>
                    <option value="asignar">Reasignar no conforme</option>
                    <option value="responder">Responder no conforme</option>
                    <option value="derrogar">Derrogar no conforme</option>
                    <option value="cerrar">Cerrar no conforme</option>
                </select>
                <br>
                <div id="asignar" style="display: none;">
                    <form action="{{ route('tramite.create', $NConforme->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    Reasignar no conformidad
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <br>
                                        <div class="col-sm-12">
                                            <label class="form_label required" for="">¿Por qué lo quiere reasignar? : </label>
                                            <textarea type="text" class="form-control upper" name="observacion" id="observacion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6 center_margin">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">¿Desea adjuntar archivos?</label>
                                                <input type="file" class="form-control" name="file" id="file">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 center_margin">
                                            <label class="form_label required" for="">Descrpción del archivo : </label>
                                            <textarea type="text" class="form-control upper" name="aDescripcion" id="aDescripcion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tramite" id="tramite" value="2">
                                    <input type="hidden" name="nConforme" id="nConforme" value="{{ $NConforme->id }}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div id="responder" style="display: none;">
                    <form action="{{ route('tramite.create', $NConforme->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    Responder no conformidad
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <br>
                                        <div class="col-sm-12">
                                            <label class="form_label required" for="">Respuesta : </label>
                                            <textarea type="text" class="form-control upper" name="observacion" id="observacion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6 center_margin">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">¿Desea adjuntar archivos?</label>
                                                <input type="file" class="form-control" name="file" id="file">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 center_margin">
                                            <label class="form_label required" for="">Descripción del archivo : </label>
                                            <textarea type="text" class="form-control upper" name="aDescripcion" id="aDescripcion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tramite" id="tramite" value="3">
                                    <input type="hidden" name="nConforme" id="nConforme" value="{{ $NConforme->id }}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div id="derrogar" style="display: none;">
                    <form action="{{ route('tramite.create', $NConforme->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    Derrogar no conformidad
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <br>
                                        <div class="col-sm-12">
                                            <label class="form_label required" for="">¿Por qué lo quiere derrogar? : </label>
                                            <textarea type="text" class="form-control upper" name="observacion" id="observacion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6 center_margin">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">¿Desea adjuntar archivos?</label>
                                                <input type="file" class="form-control" name="file" id="file">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 center_margin">
                                            <label class="form_label required" for="">Descrpción del archivo : </label>
                                            <textarea type="text" class="form-control upper" name="aDescripcion" id="aDescripcion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tramite" id="tramite" value="4">
                                    <input type="hidden" name="nConforme" id="nConforme" value="{{ $NConforme->id }}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div id="cerrar" style="display: none;">
                    <form action="{{ route('tramite.create', $NConforme->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    Finalizar no conformidad
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <br>
                                        <div class="col-sm-12">
                                            <label class="form_label required" for="">¿Por qué se va a finalizar la no conformidad? : </label>
                                            <textarea type="text" class="form-control upper" name="observacion" id="observacion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6 center_margin">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">¿Desea adjuntar archivos?</label>
                                                <input type="file" class="form-control" name="file" id="file">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 center_margin">
                                            <label class="form_label required" for="">Descrpción del archivo : </label>
                                            <textarea type="text" class="form-control upper" name="aDescripcion" id="aDescripcion" value=""
                                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tramite" id="tramite" value="5">
                                    <input type="hidden" name="nConforme" id="nConforme" value="{{ $NConforme->id }}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div id="ninguno" style="display: none;">
                    <div class="panel panel-primary" align="justify">
                        <div class="panel-heading">No se ha seleccionado ningun tramite</div>
                        <div class="panel-body">HOSPITAL DEPARTAMENTAL DE VILLAVICENCIO.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function mostrar(id) {
            if (id == "asignar") {
                $("#asignar").show();
                $("#responder").hide();
                $("#derrogar").hide();
                $("#cerrar").hide();
                $("#ninguno").hide();
            }

            if (id == "responder") {
                $("#asignar").hide();
                $("#responder").show();
                $("#derrogar").hide();
                $("#cerrar").hide();
                $("#ninguno").hide();
            }

            if (id == "derrogar") {
                $("#asignar").hide();
                $("#responder").hide();
                $("#derrogar").show();
                $("#cerrar").hide();
                $("#ninguno").hide();
            }
            if (id == "cerrar") {
                $("#asignar").hide();
                $("#responder").hide();
                $("#derrogar").hide();
                $("#cerrar").show();
                $("#ninguno").hide();
            }
            if (id == "ninguno") {
                $("#asignar").hide();
                $("#responder").hide();
                $("#derrogar").hide();
                $("#cerrar").hide();
                $("#ninguno").show();
            }

        }
    </script>
@endsection
