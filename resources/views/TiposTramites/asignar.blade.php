<div id="asignar" style="display: none;">
    <form action="{{ route('tramite.create', $NConforme->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="card">
                <div class="card-header bg-primary">
                    Reasignar no conformidad
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Proceso : </label>
                            <select class="form-control" name="proceso2" id="proceso2" required>
                                <option value="">Seleciona un proceso</option>
                                @foreach ($subProceso as $us)
                                    {{-- @if (Auth::user()->id == $us->id) --}}
                                        <option value="{{ $us->id }}">
                                            {{ $us->cargo }}
                                        </option>
                                    {{-- @endif --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Coordinador : </label>
                            <input type="text" class="form-control upper" id="reportante2" name="reportante2"
                                value="" disabled>

                        </div>
                        <div class="col-sm-4">
                            <label for="">Correo : </label>
                            <input type="text" class="form-control upper" id="correo" name="correo"
                                value="" disabled>
                            <input type="hidden" name="correoOculto" id="correoOculto" value="">
                        </div>
                    </div>
                    <input type="hidden" name="tramite" id="tramite" value="2">
                    <input type="hidden" name="observacion" id="observacion" value="observacion">
                    <input type="hidden" name="reportanteoculto" id="reportanteoculto" value="reportanteoculto">
                    <input type="hidden" name="nConforme" id="nConforme" value="{{ $NConforme->id }}">
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<script>
    $(document).on('change', '#proceso2', (e) => {
        fetch('../../NConformes/subcategorias', {
            method: 'POST',
            body: JSON.stringify({
                texto: e.target.value
            }),
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": document.querySelector(
                    'meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            return response.json()
        }).then(data => {
            for (let i in data.lista) {
                var opciones = data.lista[i].name;
                var opciones2 = data.lista[i].email;
            }
            $('#reportante2').val(opciones);
            $('#reportanteoculto').val(opciones);
            $('#correo').val(opciones2);
            $('#correoOculto').val(opciones2);

        }).catch(error => console.error(error));
    });
</script>





