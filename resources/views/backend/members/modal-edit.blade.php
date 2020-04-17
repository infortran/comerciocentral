

<!-- Modal -->
{!!Form::open(['action' => ['TeamMemberController@update', $member->id], 'method' => 'PATCH','enctype' => 'multipart/form-data'])!!}
<div class="modal fade" id="editMemberModal{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="max-width: 400px" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar miembro del equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       
                        <img class="img-responsive img-thumbnail mx-auto d-block" src="{{asset('images/uploads/members').'/'.$member->img_member}}" alt="">
                            
                    </div>
                    <div class="col-12">
                        <br>
                        <input type="file" name="img_member">
                        <br>
                        <div style="margin-top: 20px" class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                          </div>
                          <input name="nombre" value="{{$member->nombre}}" type="text" class="form-control" placeholder="Nombre del miembro" aria-label="Nombre del miembro" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-briefcase"></i></span>
                          </div>
                          <input name="cargo" value="{{$member->cargo}}" type="text" class="form-control" placeholder="Cargo del miembro" aria-label="Cargo del miembro" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    
                </div>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>
{!!Form::close()!!}