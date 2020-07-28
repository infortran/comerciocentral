{!!Form::open(['url' => 'admin/categorias'])!!}
<!-- Modal -->
<div class="modal fade" id="modal-create-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear nueva categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="categoria-input">Ingrese el nombre de la categoria</label>
                        <input name="categoria" type="text" class="form-control" id="categoria-input" >
                        <input type="hidden" name="tienda" value="{{ $tienda->id }}">
                    </div>
                </div>
                <div class="col">
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </div>
            </div>
        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="defaultButton" data-dismiss="modal">Cancelar</button>

        <button type="submit" class="addButton"><i class="fas fa-save"></i> Guardar</button>
        {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
