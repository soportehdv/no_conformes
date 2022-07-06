@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
    <div class="card">
        <div class="card-header" style="height:4em;">
            <h2>Modificar producto</h2>
        </div>

    </div>

@endsection

@section('content')



    <div class="container">

        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('compras.update', $compras->id) }}">
                    @csrf
                    <style>
                        .padding_center{
                            padding-left: 25%;
                        }
                        .texto_radio{
                            text-align: center;
                        }
                        @media (min-width: 400px) and (max-width: 767px){
                            .padding_center{
                                padding-left: 0px;
                            }
                            .texto_radio{
                                text-align: left
                            }
                            .two-column{
                                width: 50%;
                                float: left;
                            }
                        }
                        @media (min-width: 768px) and (max-width: 1413px){
                            .padding_center{
                                padding-left: 15%;
                            }
                            .texto_radio{
                                text-align: center;
                                height: 57px;
                            }

                        }
                    </style>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Serial </label>
                                <input type="text" autocomplete="on" class="form-control upper" name="serial"
                                    id="hola" value="{{ $compras->serial }}"
                                    aria-describedby="emailHelp" placeholder="Serial" required>
                                <ul id="lista_id"></ul>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Elemento </label>
                                <input type="text" class="form-control upper" name="elemento"
                                    value="{{ $compras->elemento }}"
                                    placeholder="Elemento">
                            </div>
                            <div class="col-sm-4">
                                <label for="">Caracteristicas </label>
                                <input type="text" class="form-control upper" name="caracteristicas"
                                    value="{{ $compras->caracteristicas }}"
                                    placeholder="Caracteristicas">
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Ancho </label>
                                <input type="text" class="form-control upper" name="ancho"
                                    value="{{ $compras->ancho }}"
                                    placeholder="Ancho">
                            </div>
                            <div class="col-sm-3">
                                <label for="">largo </label>
                                <input type="text" class="form-control upper" name="largo"
                                    value="{{ $compras->largo }}"
                                    placeholder="largo">
                            </div>
                            <div class="col-sm-3">
                                <label for="">color </label>
                                <input type="text" class="form-control upper" name="color"
                                    value="{{ $compras->color }}"
                                    placeholder="color">
                            </div>
                            <div class="col-sm-3">
                                <label for="">tela </label>
                                <input type="text" class="form-control upper" name="tela"
                                    value="{{ $compras->tela }}"
                                    placeholder="tela">
                            </div>
                        </div>

                    </div>

                    <br>
                    <input class="btn btn-success" type="submit" value="Ingresar" />

                </form>



            </div>
        </div>

    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script>
    $('.selectpicker').selectpicker({
        style: 'btn-default'
    });
</script>
