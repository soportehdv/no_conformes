@extends('adminlte::page')
@section('title', 'Actualizar perfil')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Actualizar perfil</h2>
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
        <br>
        <br>
        <style>
            /* input[type='file'] {
                                        display: none;
                                    } */

            #max-width {
                position: relative;
            }

            .mostrar {
                display: block;
                margin: auto;
            }

            /**********File Inputs**********/
            .container-input {
                text-align: center;
                width: 100%;
                margin: 0 auto;
                margin-top: 20px;

            }

            .inputfile {
                width: 0.1px;
                height: 0.1px;
                opacity: 0;
                overflow: hidden;
                position: absolute;
                z-index: -1;
            }

            .inputfile+label {
                max-width: 80%;
                font-size: 1.25rem;
                font-weight: 700;
                text-overflow: ellipsis;
                white-space: nowrap;
                cursor: pointer;
                display: inline-block;
                overflow: hidden;
                padding: 0.625rem 1.25rem;
            }

            .inputfile+label svg {
                width: 1em;
                height: 1em;
                vertical-align: middle;
                fill: currentColor;
                margin-top: -0.25em;
                margin-right: 0.25em;
            }

            .iborrainputfile {
                font-size: 16px;
                font-weight: normal;
                font-family: 'Lato';
            }

            /* style 1 */

            .inputfile-1+label {
                color: #fff;
                background-color: #c39f77;
            }

            .inputfile-1:focus+label,
            .inputfile-1.has-focus+label,
            .inputfile-1+label:hover {
                background-color: #9f8465;
            }
        </style>
        <div class="card">
            <div class="card-body">
                @if (Auth::user()->rol != "general")
                <form method="POST" action="{{ route('misDatosUsuario') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <div class="max-width">
                                @foreach ($files as $file)
                                    @if ($file->id == auth()->user()->image)
                                        <img src="{{ asset('files/biblioteca/' . $file->ruta) }}"
                                            class="user-image img-circle elevation-2" alt=""
                                            style="display:block; margin:auto; "width="200" height="200"
                                            id="ocultar">
                                    @endif
                                @endforeach
                                <output id="list" class="mostrar"></output>
                            </div>
                            <!--ESTILO 1-->
                            <div class="container-input">
                                <input type="file" name="file" id="file" class="inputfile inputfile-1"
                                    data-multiple-caption="{count} archivos seleccionados" multiple />
                                <label for="file">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20"
                                        height="17" viewBox="0 0 20 17">
                                        <path
                                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                                        </path>
                                    </svg>
                                    <span class="iborrainputfile">Seleccionar imagen</span>
                                </label>
                            </div>
                            <p align="center"><b>{{ auth()->user()->name }}</b></p>
                            <p align="center">{{ auth()->user()->cargo }}</p>
                            <script>
                                function archivo(evt) {
                                    var files = evt.target.files; // FileList object

                                    // Obtenemos la imagen del campo "file".
                                    for (var i = 0, f; f = files[i]; i++) {
                                        //Solo admitimos imágenes.
                                        if (!f.type.match('image.*')) {
                                            continue;
                                        }

                                        var reader = new FileReader();

                                        reader.onload = (function(theFile) {
                                            return function(e) {
                                                // Insertamos la imagen
                                                document.getElementById("list").innerHTML = [
                                                    '<img class="mostrar thumb user-image img-circle elevation-2" width="200" height="200" src="',
                                                    e.target.result, '" title="', escape(theFile.name), '"/>'
                                                ].join('');
                                                document.getElementById('ocultar').style.display = 'none';
                                            };
                                        })(f);

                                        reader.readAsDataURL(f);
                                    }
                                }

                                document.getElementById('file').addEventListener('change', archivo, false);
                            </script>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Correo de Usuario</label>
                                    <input type="text" name="name" value="{{ Auth::user()->email }}"
                                        class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="password_actual">Clave Actual</label>
                                    <input type="password" name="password_actual"
                                        class="form-control @error('password_actual') is-invalid @enderror">
                                    @error('password_actual')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="new_password ">Nueva Clave</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="confirm_password">Confirmar nueva Clave</label>
                                    <input type="password" name="confirm_password"
                                        class="form-control @error('confirm_password') is-invalid @enderror">
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                            <a class="btn btn-danger float-left" href="{{ route('home') }}">Atras</a>
                        </div>
                    </div>

                </form>
                @else
                <form method="POST" action="{{ route('misDatosUsuario') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <div class="max-width">
                                @foreach ($files as $file)
                                    @if ($file->id == auth()->user()->image)
                                        <img src="{{ asset('files/biblioteca/' . $file->ruta) }}"
                                            class="user-image img-circle elevation-2" alt=""
                                            style="display:block; margin:auto; "width="200" height="200"
                                            id="ocultar">
                                    @endif
                                @endforeach
                                <output id="list" class="mostrar"></output>
                            </div>
                            <!--ESTILO 1-->
                            <div class="container-input" style="display: none">
                                <input type="file" name="file" id="file" class="inputfile inputfile-1"
                                    data-multiple-caption="{count} archivos seleccionados" multiple />
                                <label for="file">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20"
                                        height="17" viewBox="0 0 20 17">
                                        <path
                                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                                        </path>
                                    </svg>
                                    <span class="iborrainputfile">Seleccionar imagen</span>
                                </label>
                            </div>
                            <p align="center"><b>{{ auth()->user()->name }}</b></p>
                            <p align="center">{{ auth()->user()->cargo }}</p>
                            <script>
                                function archivo(evt) {
                                    var files = evt.target.files; // FileList object

                                    // Obtenemos la imagen del campo "file".
                                    for (var i = 0, f; f = files[i]; i++) {
                                        //Solo admitimos imágenes.
                                        if (!f.type.match('image.*')) {
                                            continue;
                                        }

                                        var reader = new FileReader();

                                        reader.onload = (function(theFile) {
                                            return function(e) {
                                                // Insertamos la imagen
                                                document.getElementById("list").innerHTML = [
                                                    '<img class="mostrar thumb user-image img-circle elevation-2" width="200" height="200" src="',
                                                    e.target.result, '" title="', escape(theFile.name), '"/>'
                                                ].join('');
                                                document.getElementById('ocultar').style.display = 'none';
                                            };
                                        })(f);

                                        reader.readAsDataURL(f);
                                    }
                                }

                                document.getElementById('file').addEventListener('change', archivo, false);
                            </script>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Correo de Usuario</label>
                                    <input type="text" name="name" value="{{ Auth::user()->email }}"
                                        class="form-control @error('name') is-invalid @enderror" disabled>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <a class="btn btn-danger float-left" href="{{ route('home') }}">Atras</a>
                        </div>
                    </div>

                </form>

                @endif


            </div>
        </div>

    </div>
    {{-- @dd($errors) --}}
@endsection
@section('jsDataTable')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

@endsection
