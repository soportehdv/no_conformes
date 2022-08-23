@extends('adminlte::page')
@section('title', 'Inicio')

@section('plugins.Chartjs', true)

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Inicio</h2>
        </div>

    </div>


@endsection

@section('content')

    <div class="container">

        <div class="flexbox-container">
            <div class="small-box bg-red" style="margin-right: 10px;">
                <div class="inner">

                    @php
                        $i = 0;
                    @endphp
                    @foreach ($clientes as $cliente)
                        @if ($cliente->entregado != 0)
                            @php
                                // $i= $loop->count
                                $i = $i + 1;
                            @endphp
                        @endif
                    @endforeach
                    <h3>{{ $i }}</h3>

                    <p>Pedidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                </div>
                <a href="{{ route('clientes.lista') }}" class="small-box-footer">
                    Ver <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div class="small-box bg-info" style="margin-right: 10px;">
                <div class="inner">
                    @php
                        $jj = 0;
                    @endphp
                    @foreach ($compras as $compra)
                        @php
                            $jj = $jj + $compra->unidades;
                        @endphp
                    @endforeach
                    <h3>{{ $jj }}</h3>
                    <p>Total productos </p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-warehouse"></i>
                </div>
                <a href="{{ route('compras.lista') }}" class="small-box-footer">
                    Ver <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div class="small-box bg-warning" style="margin-right: 10px;">
                <div class="inner">
                    @php
                        $k = 0;
                    @endphp
                    @foreach ($ventas as $venta)
                        {{-- @if ($stoc->estado_id === 3) --}}
                        @php
                            // $i= $loop->count
                            $k = $k + $venta->unidades;
                        @endphp
                        {{-- @endif --}}
                    @endforeach
                    <h3>{{ $k }}</h3>
                    <p>Productos en servicio</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-dolly"></i>
                </div>
                <a href="{{ route('ventas.lista') }}" class="small-box-footer">
                    Ver <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <br>
        <table class="table table-striped table-res">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Total</th>

                    {{-- <th scope="col">Acción</th> --}}

                </tr>
            </thead>
            <tbody>
                @php
                    $j=0;
                    $suma=0;
                @endphp
                @foreach ($ubicacion as $venta)
                    {{-- @if ($venta->unidades != 0) --}}
                        <tr>
                            @php
                                $j=$j+1;
                            @endphp
                            <th scope="row">{{ $j }}</th>
                            <td>
                                @foreach ($ubicacion as $ubi)
                                        @if ($ubi->id == $j)
                                            {{ $ubi->nombre }}
                                        @endif
                                @endforeach

                            </td>
                            <td>{{ DB::table('ventas')->where('cliente_id', $j)->sum('unidades') }} </td>
                        </tr>
                    {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
        <style>
            .flexbox-container {
                display: -ms-flex;
                display: -webkit-flex;
                display: flex;
            }

            .flexbox-container>div {
                width: 33.3%;
                padding: 10px;
            }
        </style>

    </div>

@endsection
