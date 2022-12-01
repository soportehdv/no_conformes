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
            input[type='file'] {
                display: none;
            }

            #max-width {
                position: relative;
            }

            .mostrar{
                display:block;
                margin:auto;
            }

            #imgPhoto {
                margin-top: 0;
                max-width: 70px;
                width: 100%;
                padding: 0px;
                background-color: #eee;
                border: 5px solid #ccc;
                border-radius: 50%;
                cursor: pointer;
                transition: background .3s;
                position: absolute;
                top: 0px;
                left: 0px;
            }

            #imgPhoto:hover {
                background-color: rgb(180, 180, 180);
                border: 5px solid #111;
            }
        </style>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('misDatosUsuario') }}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <div class="max-width">
                                <img src="{{ asset('img/camera.png') }}" alt="Selecione uma imagem" id="imgPhoto">
                                @foreach ($files as $file)
                                    @if ($file->id == auth()->user()->image)
                                        <img src="{{ asset('files/biblioteca/' . $file->ruta) }}"
                                            class="user-image img-circle elevation-2" alt=""
                                            style="display:block; margin:auto; "width="200" height="200" id="ocultar">
                                    @endif
                                @endforeach
                                <input type="file" id="flImage" name="fImage" accept="image/*">
                                <output id="list" class="mostrar"></output>
                            </div>
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
                                           document.getElementById("list").innerHTML = ['<img class="mostrar thumb user-image img-circle elevation-2" width="200" height="200" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                                           document.getElementById( 'ocultar' ).style.display = 'none';
                                          };
                                      })(f);

                                      reader.readAsDataURL(f);
                                    }
                                }

                                document.getElementById('flImage').addEventListener('change', archivo, false);
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
                                        class="form-control @error('password_actual') is-invalid @enderror" required>
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
                                        class="form-control @error('password') is-invalid @enderror" required>
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
                                        class="form-control @error('confirm_password') is-invalid @enderror"required>
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                            <a class="btn btn-danger float-left" href="{{ URL::previous() }}">Atras</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
    {{-- @dd($errors) --}}
@endsection
@section('jsDataTable')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        'use strict'

        let photo = document.getElementById('imgPhoto');
        let file = document.getElementById('flImage');

        photo.addEventListener('click', () => {
            file.click();
        });
    </script>
@endsection
