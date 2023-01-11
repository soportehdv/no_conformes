@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Usuarios</h2>
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
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('user.create') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" class="form-control" name="email" value="@hdv.gov.co"
                            aria-describedby="emailHelp" placeholder="Ingresa email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" name="password" value="" aria-describedby="emailHelp"
                            placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirmar contraseña</label>
                        <input type="password" class="form-control" name="password_confirmation" value=""
                            aria-describedby="emailHelp" placeholder="Confirmar contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre </label>
                        <input type="text" class="form-control" name="name" value="" aria-describedby="emailHelp"
                            placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Area de servicio </label>
                        <input type="text" class="form-control" name="cargo" value="" aria-describedby="emailHelp"
                            placeholder="Proceso" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rol </label>
                        <select class="form-control" name="rol" required>
                            <option value="servicios">Servicios</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <input class="btn btn-primary float-right" onclick="this.disabled=true;this.value='Enviando.. .';this.form.submit();" name="commit" value="Agregar" type="submit">

                    <a class="btn btn-danger float-left" href="{{ URL::previous() }}">Atras</a>

                </form>

            </div>
        </div>

    </div>
    {{-- @dd($errors) --}}
@endsection
