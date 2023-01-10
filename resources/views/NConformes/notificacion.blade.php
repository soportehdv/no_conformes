@extends('adminlte::page')
@section('title', 'Notificaciones')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Notificaciones</h2>
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
        {{--  --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Notificaciones no leídas</div>
                    <div class="card-body">
@php
  $hola = 0;
@endphp
                        @if (auth()->user())
                            @forelse ($Nconformenotificacion as $notification)
                                <div class="alert alert-default-warning">
                                    No conforme de :
                                    @foreach (App\Models\User::all() as $us)
                                        @if ($us->id == $notification->data['proceso'])
                                            {{ $us->proceso }}
                                            @php
                                                $hola = $notification->data['noConformeID'];
                                            @endphp
                                        @endif
                                    @endforeach
                                    <p>{{ $notification->created_at->diffForHumans() }}</p>
                                    <button type="submit" class="mark-as-read btn btn-sm btn-dark"
                                        data-id="{{ $notification->id }}">Ver</button>
                                </div>
                                @if ($loop->last)
                                    <a href="#" id="mark-all">marcar todo como leido</a>
                                @endif
                            @empty
                                No hay notificaciones
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
@section('scripts')
    <script>
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('markNotification') }}", {
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id
                }
            });
        }
        $(function() {
            $('.mark-as-read').click(function() {
                let request = sendMarkRequest($(this).data('id'));
                var id_Nc = "<?php echo $hola  ?>";
                request.done(() => {
                    $(this).parents('div.alert').remove();
                    window.location.href = "vista/"+id_Nc;
                });
            });
            $('#mark-all').click(function() {
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.alert').remove();
                    location.reload();
                })
            });
        });
    </script>
@endsection
