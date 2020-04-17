{!!Form::open(['action' => ['MarcaController@update', $marca->id], 'method' => 'PATCH'])!!}
<!-- Modal -->
<div class="modal fade" id="modal-edit-marca{{$marca->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="marca-input">Cambie el nombre de la marca</label>
                        <input value="{{$marca->marca}}" name="marca" type="text" class="form-control" id="marca-input" >
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
        
        <button type="submit" class="addButton"><i class="fa fa-save"></i> Guardar</button>
        {!! Form::close() !!}
        
      </div>
    </div>
  </div>
</div>