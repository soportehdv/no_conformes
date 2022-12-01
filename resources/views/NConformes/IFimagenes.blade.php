<li>
    {{-- <div class="col-md-12">
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
    </div> --}}
    <div class="row">
                <div class="col-sm-6">
                    <label
                        for="">Archivo</label>
                    <div
                        style="column-gap:0px; display:grid; grid-template-columns:60px auto; grid-template-rows:auto; padding:0rem 0; width:100%">
                        <a href="{{ asset('files/biblioteca/' . $file->ruta) }}"
                            style="grid-column: 1 / 2; grid-row: 1 / 4;"
                            title=""
                            target="_blank"
                            aria-label=""><img
                                alt=""
                                class="img-fluid mimethumb"
                                src="{{ asset('img/' . 'logo-archivo.webp') }}"
                                style="height:auto; max-width:50%"
                                title=""> </a>
                        <a href="{{ asset('files/biblioteca/' . $file->ruta) }}"
                            target="_blank"><span
                                style="font-size:12px"><span
                                    style="font-family:Arial,Helvetica,sans-serif"><span
                                        style="color:#000000">{{ $file->nombre }}
                                    </span></span></span></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="">Descripción
                        del
                        archivo</label>
                    <div>
                        {{ $file->aDescripcion }}
                    </div>
                </div>
    </div>
</li>
