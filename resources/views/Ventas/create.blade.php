@extends('adminlte::page')
@section('title', 'Ventas')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Ventas</h2>
        </div>

    </div>

@endsection

@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <?php $i = 0; ?>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
    <div class="container">
        <div class="row">
            <div class="card col-sm-5" style="margin-right: 2%; margin-left: 3%;">
                <div class="card-body">
                    <form method="POST" action="{{ route('ventas.create') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-2">
                                <a class="btn btn-danger" href="{{ URL::previous() }}">Atras</a>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="button" onclick="mifuncion()">Escanear</button>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12" align="center">
                            <video id="preview" style="display: none" class="p-1 border active">
                            </video>
                            <button id="frenos" class="btn btn-primary" style="display: none" type="button"
                                onclick="frenar()">Cerrar</button>

                        </div>
                        <style>
                            #preview {
                                width: 100%;
                                margin: 0px auto;
                            }

                            @media only screen and (min-width: 1000px) {

                                /* styles for browsers larger than 1440px; */
                                #preview {
                                    width: 350px;
                                    margin: 0px auto;
                                }
                            }

                            .btn-finalizar {
                                left: 14px;
                                position: relative;
                            }
                        </style>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Se entrega a :</label>
                                <select class="form-control" name="cliente_id[]" id="select-pendiente" required>
                                    @foreach ($clientes as $cliente)
                                        @if ($cliente->entregado != 0)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Producto :</label>
                                <input type="text" class="form-control" name="stock_id[]" id="hola" required disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Unidades :</label>
                                <input type="number" min="1" class="form-control" name="unidades[]" required>
                                <input type="hidden" class="form-control" name="user[]"
                                    value='{{ Auth::user()->id }}'required>

                            </div>
                        </div>
                        {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th>Se entrega a :</th>
                                    <th>Producto</th>
                                    <th>Unidades</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        <select class="form-control" name="cliente_id[]" id="select-pendiente" required>
                                            @foreach ($clientes as $cliente)
                                                @if ($cliente->entregado != 0)
                                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="stock_id[]" id="hola" required>
                                            </div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-primary" type="button" onclick="mifuncion()">Escanear</button>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <input type="number" min="1" class="form-control" name="unidades[]" required>
                                    </th>
                                    <input type="hidden" class="form-control" name="user[]" value='{{Auth::user()->id}}'required>
                                </tr>

                            </tbody>

                        </table> --}}
                        <script type="text/javascript">
                            function mifuncion() {
                                $("#preview").show();
                                $("#frenos").show();
                                let scanner = new Instascan.Scanner({
                                    video: document.getElementById('preview')
                                });
                                scanner.addListener('scan', function(content) {
                                    // alert(content);
                                    document.getElementById('hola').value = content;
                                    scanner.stop();
                                    $("#preview").hide();
                                    $("#frenos").hide();


                                });
                                Instascan.Camera.getCameras().then(function(cameras) {
                                    if (cameras.length > 0) {
                                        scanner.start(cameras[0]);
                                    } else {
                                        console.error('No cameras found.');
                                    }
                                }).catch(function(e) {
                                    console.error(e);
                                });
                            }

                            function frenar() {
                                $("#preview").hide();
                                $("#frenos").hide();

                            }
                        </script>
                        <div class="col-sm-12 btn-finalizar">
                            <button type="submit" class="btn btn-success mt-3 float-right"><i class="fa fa-reply-all"
                                    aria-hidden="true"></i> Finalizar entrega</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="card col-sm-6">
                <div class="card-body">
                    <br>
                    <h3 align="center">Pedidos pendientes</h3>
                    <table class="table table-striped table-res">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Responsable</th>
                                <th scope="col">producto</th>
                                <th scope="col">Un.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                @if ($cliente->entregado != 0)
                                    <tr>
                                        <th scope="row">{{ $cliente->id }}</th>
                                        <td>{{ $cliente->nombre }}</td>
                                        <td>{{ $cliente->tipo }}</td>
                                        <td>{{ $cliente->entregado }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
