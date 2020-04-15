{!!Form::open(['url' => 'admin/teammember','enctype' => 'multipart/form-data'])!!}
<!-- Modal -->
<div class="modal fade" id="createMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="max-width: 400px" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear nuevo miembro del equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--.modal-header-->
      <div class="modal-body">
        

            <div class="container">
                <div class="row">
                    <div class="col-12">
                       
                        <img style="width: 100%; max-width: 200px" class="img-responsive img-thumbnail mx-auto d-block" src="{{asset('images/semantic')}}/avatar.png" alt="" id="img_new_member">
                            
                    </div><!--col-12-->
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div><!--col-12-->
                    <div class="col-12">
                        <br>
                        <input name="img_member" type="file" id="input_img_new_member">
                        <br>
                        <small>La imagen debe ser panoramica para mejor resultado</small>
                        <br>
                        <div style="margin-top: 20px" class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                          </div>
                          <input name="nombre" type="text" class="form-control" placeholder="Nombre del miembro" aria-label="Nombre del miembro" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-briefcase"></i></span>
                          </div>
                          <input name="cargo" type="text" class="form-control" placeholder="Cargo del miembro" aria-label="Cargo del miembro" aria-describedby="basic-addon1">
                        </div>
                    </div><!--col-12-->
                    
                </div><!--.row-->
            </div><!--.container-->
            
      </div><!--.modal-body-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
      </div><!--.modal footer-->
  </div><!--.modal-content-->
</div><!--.modal-dialog-->
</div><!--.modal-->
{!!Form::close()!!}