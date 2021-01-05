@extends('frontend.user.principal')

@section('content')
    <section>
        <div class="container">

            <div class="row">
                <div class="img-user-container col">
                    <h1 class="titulo-principal">Cuenta</h1>
                    <div class="img">
                        <img id="img-user" src="{{asset('images/uploads/users').'/'.Auth::user()->img}}" alt="">
                        <label for="input-img-user">
                            <i class="fa fa-camera"></i>
                        </label>
                        <input id="input-img-user" type="file" accept="image/x-png,image/jpeg" style="display:none">
                        <button class="btn-img-user" id="btn-img-user">
                            <i class="fa fa-save"></i>
                        </button>
                    </div>

                    <div class="line"></div>

                </div>
            </div>
            <div class="row">

                <div class="cuenta-user-container col cuenta-container">
                    <h4>Datos personales</h4>
                    <div class="form" >
                        <input type="text" class="form-control" placeholder="Nombre" value="{{Auth::user()->name}}">
                        <input type="text" class="form-control" placeholder="apellido" value="{{Auth::user()->lastname}}">
                    </div>
                    <div class="form">
                        <input type="email" class="form-control" placeholder="email" value="{{Auth::user()->email}}">
                        <input type="text" class="form-control" placeholder="Telefono" value="{{Auth::user()->telefono}}">
                    </div>
                    <button type="submit" class="btn-comerciocentral-dark">Modificar</button>
                </div>

            </div>
            <div class="row">
                <div class="direcciones-cuenta cuenta-container col">
                    <h4>Direcciones</h4>
                    <a href="#modal-nueva-direccion" data-toggle="modal" data-target="#modal-nueva-direccion">
                        <i class="fa fa-plus-circle"></i>
                        Agregar nueva direccion
                    </a>
                    @foreach(Auth::user()->direcciones as $direccion)
                    <div class="direccion">
                        <div class="icon-container">
                            <div class="icon"></div>
                            @if($direccion->direccion->tipo == 'casa')
                            <i class="fa fa-home" style="left: 26%;"></i>
                            @elseif($direccion->direccion->tipo == 'depto')
                                <i class="fa fa-hotel" style="left: 27% !important"></i>
                            @elseif($direccion->direccion->tipo == 'trabajo')
                                <i class="fa fa-university" style="left:30% !important"></i>
                            @elseif($direccion->direccion->tipo == 'oficina')
                                <i class="fa fa-building" style="left:32%;"></i>
                                @endif

                        </div>
                        <div class="text-container">
                            <div class="title">
                                {{$direccion->direccion->calle}}
                                Nº {{$direccion->direccion->numero}}
                                {{$direccion->direccion->departamento ? 'Depto. '.$direccion->direccion->departamento : ''}}
                            </div>
                            <div class="text">
                                {{$direccion->direccion->poblacion}}
                            </div>
                            <div class="light-text">
                                {{$direccion->direccion->ciudad}}
                            </div>
                        </div>
                        <i class="fa fa-trash"></i>
                    </div>
                        @endforeach
                </div>
                @include('frontend.user.modal-nueva-direccion')
            </div>
            <div class="row">
                <div class="cuenta-container col">
                    <h4>Cambiar la contraseña</h4>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Ingrese la contraseña actual">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Ingrese su nueva contraseña">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Repita su nueva contraseña">
                    </div>
                    <button class="btn btn-comerciocentral-dark" type="submit">Cambiar la contraseña</button>
                </div>
            </div>
            <div class="row">
                <div class="eliminar-cuenta col cuenta-container">
                    <h4>Eliminar cuenta</h4>
                    <p>Al eliminar su cuenta perderá todos los datos de sus compras, direcciones
                        y paginas en las cuales usted sea cliente</p>
                    <button class="btn btn-danger">Eliminar mi cuenta</button>
                </div>
            </div>
        </div>
    </section>


@endsection
