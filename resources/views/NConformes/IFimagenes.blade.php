<li>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1">
                <a href="{{ asset('files/biblioteca/' . $file->ruta) }}"
                    title="{{ $file->nombre }} ({{ $file->updated_at }})." target="blank">
                    @if ($file->extension == 'pdf')
                        <img src="http://www.hdv.gov.co/files/biblioteca/2022-09-27_7271042.png"
                            alt="{{ $file->nombre }} ({{ $file->updated_at }})."
                            title="{{ $file->nombre }} ({{ $file->updated_at }})." width="50" height="50"
                            class="mimethumb img-fluid">
                    @elseif ($file->mime == 'image')
                        <img src="https://www.hdv.gov.co/files/biblioteca/2022-11-09_jpg_4187.png"
                            alt="{{ $file->nombre }} ({{ $file->updated_at }})."
                            title="{{ $file->nombre }} ({{ $file->updated_at }})." width="50" height="50"
                            class="mimethumb img-fluid">
                    @endif
                </a>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <a href="{{ asset('files/biblioteca/' . $file->ruta) }}" title="{{ $file->nombre }}."
                        target="blank">{{ $file->nombre }}.</a>
                </div>
                <div class="row">
                    <a class="descarga" href="{{ asset('NConformes/download/' . $file->id) }}">{{ $file->size }}
                        KB, Descargar</a>
                </div>
            </div>
            <div class="col-md-6">
                <p>{{ $file->aDescripcion }}</p>
            </div>
        </div>
    </div>
</li>
{{-- <div class="col-md-6">
        @if ($file->extension == 'doc')
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ asset('files/biblioteca/' . $file->ruta_edit) }}"
                        title="{{ $file->nombre }}." target="blank">
                        <img src="http://www.hdv.gov.co/files/biblioteca/2022-09-27_337932.png"
                            alt="{{ $file->nombre }}." title="{{ $file->nombre }}." width="100"
                            height="100" class="mimethumb img-fluid">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <a href="{{ asset('files/biblioteca/' . $file->ruta_edit) }}"
                            title="{{ $file->nombre }}." target="blank">{{ $file->nombre }}.</a>
                    </div>
                    <div class="row">
                        <a class="descarga"
                            href="{{ asset('documentos/download/' . $file->id) }}">{{ $file->size_edit }}
                            KB, Descargar</a>
                    </div>
                </div>
            </div>
        @elseif($file->nombre != null)
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ asset('files/biblioteca/' . $file->ruta_edit) }}"
                        title="{{ $file->nombre }}." target="blank">
                        <img src="https://www.hdv.gov.co/files/biblioteca/2022-09-27_337958.png"
                            alt="{{ $file->nombre }}." title="{{ $file->nombre }}." width="100"
                            height="100" class="mimethumb img-fluid">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <a href="{{ asset('files/biblioteca/' . $file->ruta_edit) }}"
                            title="{{ $file->nombre }}." target="blank">{{ $file->nombre }}.</a>
                    </div>
                    <div class="row">
                        <a class="descarga"
                            href="{{ asset('documentos/download/' . $file->id) }}">{{ $file->size_edit }}
                            KB, Descargar</a>
                    </div>
                </div>
            </div>
        @else
            <br><br>
            <h6> No sé a subido archivos editables para este documento </h6>
        @endif
    </div> --}}
