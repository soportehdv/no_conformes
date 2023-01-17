@extends('adminlte::page')

@section('title', 'No Conformes Generales')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>No Conformes Generales</h2>
        </div>

    </div>
@endsection

@section('content')



    <div class="container">
        <a href="{{ route('NConformesGeneral.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i>
            Crear nuevo no corforme</a>
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
        <br>
        <h1 align="center">Bienvenidos</h1>
        <p style="font-size: 23px">Hola a todos, desde el botón "Crear un nuevo conforme", podrá crear y solicitar revisión de un no
            conforme por parte de su coordinador, para este posteriormente decidir si se aprueba o rechaza la solicitud.</p>
        <div class="row">
            <div class="col-sm-12">
                <img src="https://www.hdv.gov.co/files/biblioteca/2022-12-14_logoHDV1.png" alt="" width="100%">
            </div>
        </div>
        <br>

    </div>


@endsection
