@extends('backend.layout')

@section('content')
    <div class="container">

        <h1>Usuarios
            <button class="addButton float-right">
                <i class="fa fa-plus-square"></i>
                Boton inutil
            </button>
        </h1>
        <!-- ============================
          FORMULARIO DE BUSQUEDA
          ================================= -->
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <form class="search-form">
                    <input name="search" type="text" class="textbox" placeholder="Buscar usuarios">
                    <button title="Search" value="" type="submit" class="button">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>


        @if($search)
            <div class="alert alert-info">Resultados para tu busqueda <strong>"{{$search}}"</strong></div>
        @endif
    <!--.fin FORM busqueda-->



        <hr>
        <!---....FIN FORMULARIO BUSQUEDA.....-->
        <div class="col-10 mx-auto">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->lastname}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->is_banned)
                                {!! Form::open(['action' => ['AdminController@unlockUser', $user->id]]) !!}
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-lock-open"></i>
                                    Desbloquear Usuario
                                </button>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['action' => ['AdminController@banUser', $user->id]]) !!}
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-lock"></i>
                                    Bloquear Usuario
                                </button>
                                {!! Form::close() !!}
                                @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
