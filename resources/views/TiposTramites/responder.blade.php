<div id="responder" style="display: none;">
    <form action="{{ route('tramite.create', $NConforme->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="card">
                <div class="card-header bg-primary">
                    Responder no conformidad
                </div>
                <div class="card-body">
                    <div class="row">
                        <br>
                        <div class="col-sm-12">
                            <label class="form_label required" for="">Respuesta : </label>
                            <textarea type="text" class="form-control upper" name="observacion" id="observacion" value=""
                                placeholder="observaciones" cols="100" rows="5" required></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 center_margin">
                            <div class="form-group">
                                <label for="exampleInputEmail1">¿Desea adjuntar archivos?</label>
                                <input type="file" class="form-control" name="file" id="file">
                            </div>
                        </div>
                        <div class="col-sm-6 center_margin">
                            <label class="form_label required" for="">Descripción del archivo : </label>
                            <textarea type="text" class="form-control upper" name="aDescripcion" id="aDescripcion" value=""
                                placeholder="observaciones" cols="100" rows="5"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="tramite" id="tramite" value="3">
                    <input type="hidden" name="nConforme" id="nConforme" value="{{ $NConforme->id }}">
                </div>
            </div>
        </div>
        <br>
        {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
        <input class="btn btn-primary" onclick="this.disabled=true;this.value='Enviando.. .';this.form.submit();" name="commit" value="Enviar" type="submit">
    </form>
</div>
