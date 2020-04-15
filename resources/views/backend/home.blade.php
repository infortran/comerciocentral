<!--==========================================
        HOME BACKEND (Panel principal)
=============================================-->

@extends('backend.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3><strong><i class="fa fa-desktop"></i> Panel principal</strong></h3></div>

                <div class="card-body">


                    <div class="accordion" id="accordionExample">

                          <div class="card">
                            <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                <button  style="font-size: 18px" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-window-restore"></i>
                                  Navegacion superior
                                </button>
                              </h2>
                            </div><!--.card header-->
                            
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
  <!------------------------------>
                                <form class="container" action="{{route('headerfrontend.update', 1)}}" method="POST" enctype="multipart/form-data"><!--.container-->
                                  @method('PATCH')
                                  @csrf
                                  @if ($errors->any())
                                      <div class="alert alert-danger">
                                          <ul>
                                              @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                              @endforeach
                                          </ul>
                                      </div>
                                  @endif

                                  
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tel">Telefono</label>
                                                <input name="telefono" type="text" class="form-control" id="tel" placeholder="ej. +56 9 12345678" value="{{$header->telefono}}">
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="correo">Email</label>
                                                <input name="email" type="text" class="form-control" id="correo" placeholder="ej. +contacto@dominio.cl" value="{{$header->email}}">
                                            </div>
                                        </div>
                                    </div><!--...row-->
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tel">Facebook</label>
                                                <input name="facebook" type="text" class="form-control" id="tel" placeholder="ej. facebook.com/nombreusuario" value="{{$header->facebook}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tel">Twitter</label>
                                                <input name="twitter" type="text" class="form-control" id="tel" placeholder="ej. twitter.com/nombreusuario" value="{{$header->twitter}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tel">Instagram</label>
                                                <input name="instagram" type="text" class="form-control" id="tel" placeholder="ej. instagram.com/nombreusuario" value="{{$header->instagram}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tel">LinkedIn</label>
                                                <input name="linkedin" type="text" class="form-control" id="tel" placeholder="ej. linkedin.com/nombreusuario" value="{{$header->linkedin}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-12">
                                        <img class="img-thumbnail" src="/images/system/navbar-brand.png">
                                        <input type="file" name="img_header">
                                      </div>
                                    </div>
                                    <button style="margin-top:20px" class="addButton" type="submit"><i class="fa fa-save"></i> Guardar</button>
                                </form><!--.container-->
                              </div><!--.card body-->
                            </div><!--.collapse-->
                          </div><!--.card 1 navegacion superior-->



                          <div class="card"><!--.card 2 pie de pagina-->
                              <div class="card-header" id="headingTwo"><!--. card header-->
                                <h2 class="mb-0">
                                  <button style="font-size: 18px" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa fa-shoe-prints"></i>
                                    Pie de pagina
                                  </button>
                                </h2>
                              </div><!--.fin card header-->

                              <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample"><!--COLLAPSE-->
                                <div class="card-body">

<!--------------------------->      <form action="{{route('footerinfo.update', 1)}}" 
                                          class="container" method="POST">
                                         
                                          @method('PATCH')
                                           @csrf
                                        <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                      <label for="tel"><i class="fa fa-align-left"></i> Leyenda del pie de pagina</label>
                                                      <input name="info" type="text" class="form-control" id="" placeholder="Texto del pie de pagina" value="{{$footer->info}}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                      <label for="tel"><i class="fa fa-map"></i> Direccion fisica</label>
                                                      <input name="direccion" type="text" class="form-control" id="tel" placeholder="ej. Calle #000, ciudad, pais." value="{{$footer->direccion}}">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-12">
                                            <button type="submit" class="addButton float-right"><i class="fa fa-save"></i> Guardar cambios</button>
                                          </div>
                                        </div>
                                    </form>
                                    <hr><!------------------------------------------------>
                                  <h3 style="order: 1px solid red">Miembros del equipo <button class="infoButton float-right"  data-toggle="modal" data-target="#createMemberModal"><i class="fa fa-user-plus"></i> Agregar Miembro</button></h3>

                                  @include('backend.members.modal-create')
                              
                                  
   
                                      <div class="container-fluid" style="margin-top: 60px">
                                        
                                        <div class="row flex-row flex-nowrap" style="overflow-x: scroll; ">
                                          <!--FOREACH-->
                                          @foreach($members as $member)
                                          @include('backend.members.modal-edit')
                                           @include('backend.members.modal-destroy')
                                          <div class="col-6 col-lg-4" >
                                            <div class="card">

                                              <button  data-toggle="modal" data-target="#destroyMemberModal{{$member->id}}" type="button" style="cursor:pointer;position: absolute;top: 10px;right: 10px" class="close"><i class="fa fa-times"></i></button>

                                              <img style="max-height: 100px" class="card-img-top img-thumbnail" src="{{asset('images/uploads/members') .'/'.$member->img_member}}" alt="">

                                              <div class="card-body text-center">
                                                <h5 class=" text-center">
                                                  {{$member->nombre}}
                                                </h5>


                                                <p class="card-text">
                                                  {{$member->cargo}}
                                                </p>
                                                <div class="container" style="padding:0">
                                                    <div class="row" >
                                                        <div class="col-12" style="padding:0">
                                                            <button class="btn btn-warning"  data-toggle="modal" data-target="#editMemberModal{{$member->id}}"><i class="fa fa-edit"></i> Editar</button>
                                                        </div>
                                                        <!--div class="col-6">
                                                            <button data-toggle="modal" data-target="#destroyMemberModal" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                                        </div-->
                                                    </div>
                                                </div>
                                              </div><!--.card-body-->
                                            </div><!--.card-->
                                          </div><!--.col-6 col-lg-3-->
                                          @endforeach
                                          <!--ENDFOREACH-->
                                        </div><!--.flex row-->
                                      </div><!--.container fluid-->


                                </div><!--CARD BODY COLLAPSE-->
                                     
                              </div><!-- FIN COLLAPSE-->
                          </div><!--.card 2 pie de pagina-->



                          <!--CARD 3-->
                          <div class="card">
                            <div class="card-header" id="headingThree">
                              <h2 class="mb-0">
                                <button style="font-size: 18px" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  <i class="fa fa-home"></i>
                                  Home
                                </button>
                              </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                              </div>
                            </div>
                          </div><!--.card3-->

                          <div class="card">
                            <div class="card-header" id="headingFour">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                  Pie de pagina
                                </button>
                              </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                              <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                              </div>
                            </div>
                          </div><!--.card4-->

                          <div class="card">
                            <div class="card-header" id="headingFive">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                  Pie de pagina
                                </button>
                              </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                              <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                              </div>
                            </div>
                          </div><!--.card5-->


                        </div><!--.accordion-->
                        
                    

                   
                </div><!--...card body-->
            </div><!--...card-->
        </div><!--...col-md-8-->
        
        
        <div class="col-md-4">
          {!!Form::open(['enctype' => 'multipart/form-data', 'method' => 'PATCH', 'action' =>['AdminController@update' , Auth::user()->id]])!!}
            <div class="card" >
              <div class="card-header">
                <strong><i class="fa fa-user-cog"></i> Datos del Administrador</strong>
              </div><!--.card-header-->
              <img id="img_admin" style="max-height: 300px;-o-object-fit: contain;object-fit: contain;" src="{{asset('images/uploads/admin') .'/'. Auth::user()->img}}" class="card-img-top img-thumbnail" alt="...">
              <div class="card-body">

                <div class="container">
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
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>
                    <input name="name" id="input_edit_name_admin" disabled value="{{Auth::user()->name}}" type="text" class="form-control" placeholder="Nombre del administrador" aria-label="Nombre Administrador" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-at"></i></span>
                    </div>
                    <input name="email" id="input_edit_email_admin" disabled value="{{Auth::user()->email}}" type="text" class="form-control" placeholder="Email del administrador" aria-label="Email Administrador" aria-describedby="basic-addon1">
                </div>
                <br>
                <input accept="image/x-png,image/gif,image/jpeg" name="img" id="input_edit_img_admin" type="file" disabled>
                <small>El archivo no debe superar los 300x300 pixeles.</small>
                <hr>
                <div style="margin-top: 20px" class="row">
                  <div class="col-6">
                    <button id="btn_edit_admin" class="btn btn-primary btn-block"><i class="fa fa-user-edit"></i> Editar</button>
                    <button style="display:none" type="submit" id="btn_update_admin" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                  </div>
                  <div style="padding-left: 0" class="col-6">
                    <button type="button" id="btn_edit_pass_admin" class="btn btn-danger btn-block"><i class="fa fa-user-lock"></i> Contraseña</button>
                  </div>
                </div>
                <br>
                
                <div style="display: none" id="div_cancel_edit_admin" class="row">
                  <div class="col text-center">
                    <button id="btn_cancel_edit_admin" type="button" class="btn btn-danger btn-block">Cancelar</button>
                  </div>
                </div>
                

                
              </div>
              
            </div><!--.card-->
            {!!Form::close()!!}
        </div><!--....col-md-4-->
        
    </div><!--...row-->
</div>
@endsection
