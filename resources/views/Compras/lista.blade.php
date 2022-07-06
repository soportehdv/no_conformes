@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Productos</h2>
        </div>

    </div>
    @if ($search)
        <div class="alert alert-primary" role="alert">
            Los resultados para su busqueda '{{ $search }}' son:
            <button type="button" class="close" data-dismiss="alert" style="color:white">&times;</button>
        </div>
    @endif

@endsection

@section('content')



    <div class="container">
        <a href="{{ route('compras.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir
            nuevo</a>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <br>
                <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
        <br>
        <table class="table table-striped table-res">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="background-color:#343a40; color:white;">Serial</th>
                    <th>Elemento</th>
                    <th>Caracteristica</th>
                    <th>Ancho</th>
                    <th>Largo</th>
                    <th>color</th>
                    <th>tela</th>
                    <th>Unidades</th>
                    {{-- <th>Acción</th> --}}

                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <th>{{ $compra->id }}</th>
                        <td style="text-transform: uppercase">{{ $compra->serial }}</td>
                        <td>{{ $compra->elemento }}</td>
                        <td>{{ $compra->caracteristicas }}</td>
                        <td style="text-transform: uppercase">{{ $compra->ancho }}</td>
                        <td>{{ $compra->largo }}</td>
                        <td style="text-transform: uppercase">{{ $compra->color }}</td>
                        <td>{{ $compra->tela }}</td>
                        <td>{{ $compra->uni }}</td>
                        <td><a href="{{ route('compras.update.vista', $compra->id) }}"
                                class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
        {{ $compras->links() }}

    </div>



@endsection
