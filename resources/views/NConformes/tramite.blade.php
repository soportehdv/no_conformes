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
                    @switch($NConforme->status)
                        @case(1)
                            <option value="ninguno">Seleccione un tramite</option>
                            <option value="asignar">Reasignar no conforme</option>
                            <option value="responder">Responder no conforme</option>
                            <option value="derrogar">Derrogar no conforme</option>
                            <option value="cerrar">Cerrar no conforme</option>
                        @break

                        @case(2)
                            <option value="ninguno">Seleccione un tramite</option>
                            <option value="asignar">Reasignar no conforme</option>
                            <option value="responder">Responder no conforme</option>
                            <option value="derrogar">Derrogar no conforme</option>
                            <option value="cerrar">Cerrar no conforme</option>
                        @break

                        @case(3)
                            <option value="ninguno">Seleccione un tramite</option>
                            <option value="asignar">Reasignar no conforme</option>
                            <option value="responder">Responder no conforme</option>
                            <option value="derrogar">Derrogar no conforme</option>
                            <option value="cerrar">Cerrar no conforme</option>
                        @break

                        @case(4)
                            <option value="errorDerrogado">Seleccione un tramite</option>
                            <option value="errorDerrogado">Reasignar no conforme</option>
                            <option value="errorDerrogado">Responder no conforme</option>
                            <option value="errorDerrogado">Derrogar no conforme</option>
                            <option value="errorDerrogado">Cerrar no conforme</option>
                        @break

                        @case(5)
                            <option value="ninguno">Seleccione un tramite</option>
                            <option value="asignar">Reasignar no conforme</option>
                            <option value="responder">Responder no conforme</option>
                            <option value="derrogar">Derrogar no conforme</option>
                            <option value="cerrar">Cerrar no conforme</option>
                        @break

                        @default
                    @endswitch

                </select>
                <br>
                @include('TiposTramites/asignar')

                @include('TiposTramites/responder')

                @include('TiposTramites/derrogar')

                @include('TiposTramites/cerrar')

                @include('TiposTramites/errorDerrogado')
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
            if (id == "errorDerrogado") {
                $("#errorDerrogado").show();
            }

        }
    </script>
@endsection
