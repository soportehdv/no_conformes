@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2 style="float:left">Devoluciones</h2>



        </div>

    </div>


@endsection

@section('content')
    <div class="container">
        <div class="container">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('alert-' . $msg) }}
                    </div>
                @endif
            @endforeach
            {{-- <div>
                <div align="justify"><b><h3>¿ A donde se va a devolver el producto ?</h3></b></div>
                <input type="radio" name="paciente" value="Si" onChange="mostrar(this.value);"> Al almacen&nbsp;&nbsp;&nbsp;
                <input type="radio" name="paciente" value="No" onChange="mostrar(this.value);"> Al proveedor
            </div> --}}
            <br>
            {{-- <table class="table table-res table-striped" id="Si" style="display: none;"> --}}
            <table class="table table-res table-striped">

                <thead>
                    <tr>
                        <th>id</th>
                        <th style="background-color:#343a40; color:white;">Serial</th>
                        <th>Unidades</th>
                        <th>Ubicacion</th>
                        <th>Estado</th>
                        <th>Bodega</th>


                        {{-- @if (Auth::user()->rol == "admin")
                        <th>Acción</th>
                        @endif --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        {{-- @if ($stoc->unidades === 0) --}}
                            <tr>
                                <th>{{ $compra->id }}</th>
                                <td>{{ $compra->serial }}</td>
                                <td>{{ $compra->unidades }}</td>
                                @if ($compra->estado_ubi === 'Bodega')
                                    <td>
                                        <span class="badge badge-pill badge-success">{{$compra->estado_ubi}}</span>
                                    </td>
                                @else ()
                                    <td>
                                        <span class="badge badge-pill badge-danger">{{$compra->estado_ubi}}</span>
                                    </td>
                                @endif


                                @if ($compra->estados === 'Vacio')
                                    <td>
                                        <span class="badge badge-pill badge-danger">Vacio</span>
                                    </td>
                                @elseif ($compra->estados === 'Lleno')
                                    <td>
                                        <span class="badge badge-pill badge-success">Lleno</span>
                                    </td>
                                @elseif ($compra->estados === 'En servicio')
                                    <td>
                                        <span class="badge badge-pill badge-warning">En servicio</span>
                                    </td>
                                @endif
                                {{-- <td><a href="{{ route('compras.updateProducto.vista', $compra->id) }}"
                                    class="btn btn-primary mb-2"><i class="fas fa-edit"></i></a>
                                </td> --}}

                                {{-- @if (Auth::user()->rol == "admin")
                                <td><a href="{{ route('compras.update.vista', $stoc->id) }}"
                                        class="btn btn-primary mb-2"><i class="fas fa-edit"></i> Editar</a>
                                </td>
                                @endif --}}

                            </tr>
                        {{-- @endif --}}
                    @endforeach

                </tbody>
            </table>
        {{ $compras->links() }}

        </div>



    @endsection

