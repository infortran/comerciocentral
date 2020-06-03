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
                                                <label for="tel">Telefono del sitio</label>
                                                <input name="telefono" type="text" class="form-control" id="tel" placeholder="ej. +56 9 12345678" value="{{$tienda->telefono}}">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="correo">Email del sitio</label>
                                                <input name="email" type="text" class="form-control" id="correo" placeholder="ej. +contacto@dominio.cl" value="{{$tienda->email}}">
                                            </div>
                                        </div>
                                    </div><!--...row-->
                                    <hr>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <img class="img-thumbnail" src="/images/system/navbar-brand.png">
                                        <input type="file" name="img_header">
                                      </div>
                                    </div>
                                    <button style="margin-top:20px" class="addButton" type="submit"><i class="fa fa-save"></i> Guardar</button>
                                </form><!--.container-->

                                  <div class="row card">


                                                <div class="card-header">
                                                    Redes sociales del sitio
                                                </div>

                                                  <ul class="list-group list-group-flush">
                                                      <li id="btn-add-social-site" class="list-group-item text-center" style="color: #afafaf;cursor:pointer">
                                                          <i class="fa fa-plus-circle"></i>
                                                          Agregar red social al sitio
                                                      </li>
                                                      <li class="list-group-item" id="form-agregar-social-site">
                                                          {!! Form::open(['route' => ['social.site.add']]) !!}
                                                          <div class="row" style="margin-top: 10px">

                                                              <div class="col-10">
                                                                  <select name="social_id" class="form-control">
                                                                      @foreach($socials as $social)
                                                                          <option value="{{$social->id}}">{{$social->nombre}}</option>
                                                                      @endforeach
                                                                  </select>
                                                              </div>
                                                              <div class="col-2" style="display: flex; align-items: center">
                                                                  <h2 id="btn-back-social-site" style="cursor: pointer"><i class="fa fa-angle-up"></i></h2>
                                                              </div>

                                                          </div>
                                                          <div class="row" style="margin-top: 10px">
                                                              <div class="col-10">
                                                                  <input name="uri" type="text "class="form-control" placeholder="URL de tu red social">
                                                              </div>
                                                              <div class="col-2">

                                                                  <button type="submit" class="btn btn-primary">
                                                                      <i class="fa fa-plus"></i>
                                                                  </button>
                                                              </div>
                                                          </div>
                                                          {!! Form::close() !!}
                                                      </li>
                                                      @foreach($site_socials as $social)
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-10">
                                                                      <i class="fab fa-{{$social->socials->nombre}}"></i>
                                                                      {{$social->uri }}
                                                                  </div>
                                                                  <div class="col-2" style="display: flex; align-items: center">
                                                                      {!! Form::open([ 'route' => ['social.site.delete', $social->id]]) !!}
                                                                      <button type="submit" class="btn btn-danger" style="padding:0;border-radius: 50%; width: 30px;height: 30px">
                                                                          <i class="fa fa-times"></i>
                                                                      </button>
                                                                      {!! Form::close() !!}
                                                                  </div>
                                                              </div>
                                                          </li>
                                                      @endforeach
                                                  </ul>


                                      <!--=====SOCIAL SITE FIN==========-->
                                  </div>
                              </div><!--.card body-->
                            </div><!--.collapse-->
                          </div><!--.card 1 navegacion superior-->


                        <!--========================
                               CARD PIE DE PAGINA
                        =========================-->
                          <div class="card"><!--.card 2 pie de pagina-->
                              <div class="card-header" id="headingTwo"><!--. card header-->
                                <h2 class="mb-0">
                                  <button style="font-size: 18px" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa fa-shoe-prints"></i>
                                    Pie de pagina
                                  </button>
                                </h2>
                              </div><!--.fin card header-->

                              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample"><!--COLLAPSE-->
                                <div class="card-body">

<!--------------------------->      <form action="{{route('footerinfo.update', 1)}}"
                                          class="container" method="POST">

                                          @method('PATCH')
                                           @csrf
                                        <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                      <label for="tel"><i class="fa fa-align-left"></i> Leyenda del pie de pagina</label>
                                                      <input name="info" type="text" class="form-control" id="" placeholder="Texto del pie de pagina" value="{{$tienda->info}}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                      <label for="tel"><i class="fa fa-map"></i> Direccion fisica</label>
                                                      <input name="direccion" type="text" class="form-control" id="tel" placeholder="ej. Calle #000, ciudad, pais." value="">
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
                                  <h3>Miembros del equipo <button class="infoButton float-right"  data-toggle="modal" data-target="#createMemberModal"><i class="fa fa-user-plus"></i> Agregar Miembro</button></h3>

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


                            @include('backend.slides.modal-create')

                          <!--========================
                                   CARD SLIDES
                            =========================-->
                          <div class="card">
                            <div class="card-header" id="headingThree">
                              <div class="row">
                                  <div class="col-10">
                                      <button style="font-size: 18px" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                          <i class="fa fa-images"></i>
                                          Slides
                                      </button>
                                  </div>
                                <div class="col-2"  style="display:flex;align-items: center">
                                    <span style="font-size: 14px" class="badge badge-pill badge-primary float-right">{{$slides->count()}}</span>
                                </div>
                              </div>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                <button data-target="#modal-create-slide" data-toggle="modal" class="addButton float-right"><i class="fa fa-image"></i> Nuevo slide</button>
                                  <br><br>
                                  <hr>
                                    <div class="container">
                                        <div class="row flex-row flex-nowrap" style="overflow-x: scroll;">

                                            @foreach($slides as $slide)
                                                @include('backend.slides.modal-edit')
                                                @include('backend.slides.modal-destroy')
                                            <div class="col-6 col-lg-4">
                                                <div class="card">
                                                    <button  data-toggle="modal" data-target="#modal-destroy-slide{{$slide->id}}" type="button" style="cursor:pointer;position: absolute;top: 10px;right: 10px;z-index: 100" class="close"><i class="fa fa-times"></i></button>

                                                    <div id="carouselExampleSlidesOnly" class="carousel slide card-img-top" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <img src="{{asset('images/uploads/slides').'/'.$slide->img}}" class="d-block w-100" alt="...">
                                                            </div>
                                                            <div class="carousel-item">
                                                                <img src="{{asset('images/uploads/slides').'/'.$slide->img_pricing}}" class="d-block w-100" alt="...">
                                                            </div>
                                                            <div class="carousel-item">
                                                                <img src="{{asset('images/uploads/slides').'/'.$slide->logo}}" class="d-block w-100" alt="...">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-body text-center">
                                                        <h5>{{$slide->titulo}}</h5>
                                                        <p class="card-text">{{$slide->texto}}</p>
                                                        <button class="btn btn-primary"disabled>{{$slide->txt_boton}}</button>
                                                        <hr>
                                                        <button data-toggle="modal" data-target="#modal-edit-slide{{$slide->id}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                                            Editar</button>

                                                    </div>
                                                </div><!--.card-->
                                            </div><!--============.col-6 col-lg-4===========-->

                                            @endforeach
                                        </div><!--========.row=============-->
                                    </div>
                              </div>
                            </div>
                          </div><!--.card3-->

                        <!--========================
                               CARD SOCIALS
                        =========================-->
   <!--.card4-->          <div class="card">
                            <div class="card-header" id="headingTwo">
                                <div class="row">
                                    <div class="col-10">
                                        <button style="font-size: 18px"  class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSocials" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fa fa-users"></i>
                                            Redes sociales

                                        </button>
                                    </div>
                                    <div class="col-2" style="display:flex;align-items: center">
                                        <span style="font-size: 14px" class="badge badge-pill badge-primary float-right">{{$socials->count()}}</span>
                                    </div>

                                </div>

                            </div>
                            <div id="collapseSocials" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSocials">
                                <ul class="list-group list-group-flush">
                                    <li id="btn-create-social" class="list-group-item text-center" style="color: #afafaf;cursor:pointer">
                                        <i class="fa fa-plus-circle"></i>
                                        Agregar nueva red social
                                    </li>
                                    {!! Form::open(['url' => 'admin/socials']) !!}
                                    <li style="display: none" class="list-group-item" id="form-agregar-social">
                                        <div class="row">
                                            <div class="col-10">
                                                <input name="nombre" type="text "class="form-control" placeholder="Nombre de la red">
                                            </div>
                                            <div class="col-2">
                                                <h2 id="btn-back-social" style="cursor: pointer"><i class="fa fa-angle-up"></i></h2>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-10">
                                                <input name="url" type="text" class="form-control" placeholder="URL de la red">
                                            </div>
                                            <div class="col-2" style="display: flex; align-items: center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    {!! Form::close() !!}
                                    @foreach($socials as $social)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10">
                                                    <i class="fab fa-{{$social->nombre}}"></i>
                                                    {{$social->url}}
                                                </div>
                                                <div class="col-2" style="display: flex; align-items: center">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['socials.destroy', $social->id]]) !!}
                                                    <button type="submit" class="btn btn-danger" style="padding:0;border-radius: 50%; width: 30px;height: 30px">
                                                        <i class="fa fa-minus-circle"></i>
                                                    </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--.card4-->


                        <!--========================
                               CARD Envio
                        =========================-->
                          <div class="card">
                            <div class="card-header" id="headingFive">
                              <h2 class="mb-0">
                                <button  style="font-size: 18px" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <i class="fa fa-shipping-fast"></i>
                                    Envio y transporte
                                </button>
                              </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                              <div class="card-body">
                                  <ul class="list-group list-group-flush">
                                      <li id="btn-create-envio" class="list-group-item text-center" style="color: #afafaf;cursor:pointer">
                                          <i class="fa fa-plus-circle"></i>
                                          Agregar nuevo medio de envio
                                      </li>
                                      {!! Form::open(['route' => 'envios.store']) !!}
                                      <li style="display: none" class="list-group-item" id="form-agregar-envio">
                                          <div class="row">
                                              <div class="col-8">

                                                  <textarea name="descripcion" class="form-control" id="" placeholder="Descripcion del envio"></textarea>
                                              </div>
                                              <div class="col-2">
                                                  <button type="submit" class="btn btn-primary">
                                                      <i class="fa fa-plus"></i>
                                                  </button>
                                              </div>
                                              <div class="col-2">
                                                  <h2 id="btn-back-envio" style="cursor: pointer"><i class="fa fa-angle-up"></i></h2>
                                              </div>
                                          </div>
                                          <div class="row" style="margin-top: 10px">
                                              <div class="col-4">
                                                  <input name="precio" type="number" class="form-control" placeholder="Coste del envio">
                                              </div>
                                              <div class="col-4" style="display: flex; align-items: center">
                                                  <input class="form-control" type="number" name="min_price" placeholder="Desde">
                                              </div>
                                              <div class="col-4" style="display: flex; align-items: center">
                                                  <input class="form-control" type="number" name="max_price" placeholder="Hasta">
                                              </div>
                                          </div>


                                      </li>
                                      {!! Form::close() !!}
                                      <li class="list-group-item">
                                          <table class="table table-striped">
                                              <thead>
                                                    <tr>
                                                        <th>Descripcion</th>
                                                        <th>Coste de envio</th>
                                                        <th class="d-none d-sm-table-cell">Desde</th>
                                                        <th class="d-none d-sm-table-cell">Hasta</th>
                                                        <th></th>
                                                    </tr>
                                              </thead>
                                              <tbody>
                                              @foreach($envios as $envio)
                                                    <tr>
                                                        <td>{{$envio->descripcion}}</td>
                                                        <td>$ {{number_format($envio->precio)}}</td>
                                                        <td class="d-none d-sm-table-cell">$ {{number_format($envio->min_price)}}</td>
                                                        <td class="d-none d-sm-table-cell">$ {{number_format($envio->max_price)}}</td>
                                                        <td>
                                                            {!! Form::open(['id' => '','method' => 'DELETE', 'route' => ['envios.destroy', $envio]]) !!}
                                                            <button type="submit" style="background: transparent; border-color: transparent">
                                                                <i class="fa fa-window-close" style="color: red" ></i>
                                                            </button>

                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>
                                      </li>

                                          <!--li class="list-group-item">
                                              <div class="row">
                                                  <div class="col-4">
                                                      <i class="fab fa-"></i>

                                                  </div>
                                                  <div class="col-2" style="display: flex; align-items: center">
                                                      {!! Form::open(['method' => 'DELETE', 'route' => ['envios.destroy', 1]]) !!}
                                                      <button type="submit" class="btn btn-danger" style="padding:0;border-radius: 50%; width: 30px;height: 30px">
                                                          <i class="fa fa-minus-circle"></i>
                                                      </button>
                                                      {!! Form::close() !!}
                                                  </div>
                                              </div>

                                          </li-->

                                  </ul>
                              </div>
                            </div>
                          </div><!--.card5-->


                        </div><!--.accordion-->




                </div><!--...card body-->
            </div><!--...card-->
        </div><!--...col-md-8-->

        <!--===================================
            DATOS DEL ADMINISTRADOR
        ==================================-->
        @include('backend.templates.modal-confirmar-password')
        <div class="col-md-4">

            <form action="{{ route('admin.update',['domain' => $domain, Auth::user()->id]) }}" enctype="multipart/form-data" class="card" >
              <div class="card-header">
                <strong><i class="fa fa-user-cog"></i> Datos del Administrador</strong>
              </div><!--.card-header-->
              <img id="img_admin" style="max-height: 300px;-o-object-fit: contain;object-fit: contain;" src="{{asset('images/uploads/users') .'/'. Auth::user()->img}}" class="card-img-top img-thumbnail" alt="...">
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
                <small>Tamaño ideal 300x300 pixeles.</small>
                <hr>
                <div style="margin-top: 20px" class="row">
                  <div class="col-6">
                    <button id="btn_edit_admin" class="btn btn-primary btn-block"><i class="fa fa-user-edit"></i> Editar</button>
                    <button style="display:none" type="submit" id="btn_update_admin" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                  </div>
                  <div style="padding-left: 0" class="col-6">
                    <button type="button" data-toggle="modal" data-target="#modal-confirmar-password" class="btn btn-danger btn-block"><i class="fa fa-user-lock"></i> Contraseña</button>
                  </div>
                </div>
                <br>

                <div style="display: none" id="div_cancel_edit_admin" class="row">
                  <div class="col text-center">
                    <button id="btn_cancel_edit_admin" type="button" class="btn btn-danger btn-block">Cancelar</button>
                  </div>
                </div>



              </div>

            </form><!--.Form User-->


            <!--div class="card">
                <div class="card-header">
                    Redes sociales del administrador
                    <button title="Agregar " class="btn btn-primary float-right" style="padding:0;border-radius: 50%;width: 30px; height: 30px" >
                        <i class="fa fa-plus-circle"></i>
                    </button>

                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>

                </ul>

            </div-->
            <div class="accordion" id="accordionSocials">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div class="row">
                            <div class="col-10">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSocialUser" aria-expanded="false" aria-controls="collapseTwo">
                                    Redes sociales de administrador

                                </button>
                            </div>
                            <div class="col-2" style="display:flex;align-items: center">
                                <span style="font-size: 14px" class="badge badge-pill badge-primary float-right">{{Auth::user()->socials->count()}}</span>
                            </div>

                        </div>
                    </div>

                    <div id="collapseSocialUser" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionSocials">
                        <ul class="list-group list-group-flush">
                            <li id="btn-add-social-user" class="list-group-item text-center" style="color: #afafaf;cursor:pointer">
                                <i class="fa fa-plus-circle"></i>
                                Agregar red social a administrador
                            </li>
                            <li style="display: none" class="list-group-item" id="form-agregar-social-user">

                                {!! Form::open(['route' => ['social.user.add', Auth::user()->id]]) !!}
                                <div class="row" style="margin-top: 10px">

                                    <div class="col-10">
                                        <select name="social_id" class="form-control">
                                            @foreach($socials as $social)
                                                <option value="{{$social->id}}">{{$social->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2" style="display: flex; align-items: center">
                                        <h2 id="btn-back-social-user" style="cursor: pointer"><i class="fa fa-angle-up"></i></h2>
                                    </div>

                                </div>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-10">
                                        <input name="uri" type="text "class="form-control" placeholder="URL de tu red social">
                                    </div>
                                    <div class="col-2">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </li>

                            @foreach(Auth::user()->socials as $social)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10">
                                            <i class="fab fa-{{$social->nombre}}"></i>
                                            {{$social->pivot->uri }}
                                        </div>
                                        <div class="col-2" style="display: flex; align-items: center">
                                            {!! Form::open([ 'route' => ['social.user.detach',Auth::user()->id, $social->id]]) !!}
                                            <button type="submit" class="btn btn-danger" style="padding:0;border-radius: 50%; width: 30px;height: 30px">
                                                <i class="fa fa-minus-circle"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>


            </div>
        </div><!--.datos admin-->

    </div><!--...row-->
</div>
@endsection
