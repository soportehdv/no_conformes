@extends('adminlte::page')
@section('title', 'No Conformes')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>No Conformes</h2>
        </div>

    </div>
@section('cssDataTable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
@endsection

@endsection

@section('content')



<div class="container">
    <a href="{{ route('NConformes.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir
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
    <table id="Nconformes" class="table table-striped table-bordered shadow-lg mt-4 display compact"
        style="font-size: 16px;">
        <thead class="bg-primary text-white">
            <tr>
                <th>Codigo</th>
                <th>Fecha No Conforme</th>
                <th>Quien se queja</th>
                <th>De quien se queja</th>
                <th>Estado</th>
                {{-- <th>Acción</th> --}}

            </tr>
        </thead>
        <tbody>
            @foreach ($NConformes as $nC)
                <tr>
                    <th>{{ $nC->id }}</th>
                    <td>{{ $nC->fReporte }}</td>
                    <td>{{ $nC->proceso }}</td>
                    <td>{{ $nC->nDueñoP }}</td>
                    <td>{{ $nC->estado }}</td>
                    {{-- <td><a href="{{ route('nCs.update.vista', $compra->id) }}"
                                class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                        </td> --}}

                </tr>
            @endforeach


        </tbody>
    </table>

</div>

@section('jsDataTable')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#Nconformes').DataTable({
                "language": {
                    searchPanes: {
                        title: {
                            _: 'Total de filtros selecionados - %d',
                            0: 'Selecione un opción para filtrar tu busqueda',
                            1: 'Se ha selecionado un filtro'
                        },
                        "clearMessage": "Borrar seleccionados",
                        "showMessage": "Mostrar Todo",
                        "collapseMessage": "Contraer Todo",
                        count: '{total}',
                        countFiltered: '{shown} ({total})',
                    },
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se ha encontrado nada relacionado - Disculpa",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "print": "Imprimir",
                    }
                }
            });
        });
    </script>
@endsection

@endsection
