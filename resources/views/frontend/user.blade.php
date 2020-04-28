@extends('frontend.templates.principal')

@section('content')
    <section>
        <div class="container">
            <h1 class="titulo-principal">Perfil del usuario</h1>
            <div class="row" style="margin:20px 5px 120px 5px">

                <div class="col-sm-10 col-sm-offset-1">

                    <hr>
                    <div class="card" style="margin:0;padding:0;position:relative">
                        <div class="row" style="margin:0;padding:0">
                            <div class="col-sm-4 text-center" style="max-width:450px;min-height:300px;background: linear-gradient(#e2e2e2, #b6b6b6); padding:20px">
                                <img id="img-user img-thumbnail" class="img-responsive img-circle" style="
                                max-width:200px;
                                max-height: 300px;
                                position:relative;
                                margin: 0 auto;" src="{{asset('images/uploads/users').'/'.Auth::user()->img}}" alt="">

                                <label style="display:inline-block" class="infoButton">
                                    <i class="fa fa-image"></i>
                                   <small style="font-size: 12px">Cambiar mi imagen de perfil</small>
                                    <input style="display: none" type="file">
                                </label>


                                <ul class="list-group text-left" style="margin-top: 30px">
                                    <li class="list-group-item">
                                        <strong>Actividad</strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge" style="background: #ff8c00">{{Auth::user()->comentarios->count()}}</span>
                                        Comentarios
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-8 form-user">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="input-nombre">Nombre</label>
                                        <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-user"></span>
                                        </span>
                                            <input id="input-nombre" value="{{Auth::user()->name}}" type="text" class="form-control" placeholder="Nombre de usuario" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="input-apellido">Apellido</label>
                                        <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-user"></span>
                                        </span>
                                            <input id="input-apellido" value="{{Auth::user()->lastname}}" type="text" class="form-control" placeholder="Nombre de usuario" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>


                                    <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Correo electronico</label>
                                        <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-envelope"></span>
                                        </span>
                                            <input value="{{Auth::user()->email}}" type="text" class="form-control" placeholder="Correo electronico" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Telefono</label>
                                        <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-phone"></span>
                                        </span>
                                            <input value="{{Auth::user()->telefono}}" type="text" class="form-control" placeholder="Correo electronico" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>

                                    <br>
                                <label for="">Direccion</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-map"></span>
                                        </span>
                                        <select class="form-control" name="" id="">
                                            @foreach(Auth::user()->direccions as $direccion)
                                                    <option value="">{{$direccion->calle}},
                                                        {{$direccion->numero}},
                                                        @if($direccion->departamento)
                                                    {{$direccion->departamento . ','}}
                                                        @endif
                                                    {{$direccion->poblacion}},
                                                    {{$direccion->ciudad}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <button class="btn-link" data-target="#modal-add-direccion" data-toggle="modal">
                                        <i class="fa fa-plus"></i>
                                        Agregar nueva direccion</button>

                                <hr style="border-color: #d2d2d2">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-save"></i>
                                        Guardar cambios
                                    </button>

                            </div>

                            <div class="row">
                                <div class="col-6">
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
                </div>
            </div>
        </div>
    </section>

    @include('frontend.templates.modals.modal-add-direccion-user');
@endsection
