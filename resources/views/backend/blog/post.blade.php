@extends('backend.layout')

@section('content')
    <div class="container">
        <h1>{{$post->titulo}}</h1>

        <hr>
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid" src="{{asset('images/uploads/blog').'/'.$post->img}}" alt="">
                <p>Autor: {{$user_post->name}}</p>
            </div>
            <div class="col-md-8">
                <p>{{$post->contenido}}</p>


            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-4">
                        <small>Hora creación: {{$post->created_at->format('H:i')}}</small>
                    </div>
                    <div class="col-4">
                        <small>Fecha creación: {{$post->created_at->format('Y-m-d')}}</small>
                    </div>
                    <div class="col-4">
                        <small>{{$post->created_at->diffForHumans()}}</small>
                    </div>
                </div>

            </div>
        </div>
        <!--/.row-->
        <br>

        <h3>Comentarios ({{$comentarios->count()}})</h3>
        <hr>
        <div class="row">
            <?php use App\User; ?>
            @foreach($comentarios as $comentario)
                <?php $user_coment = User::findOrFail($comentario->id_user); ?>
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <img class="card-img rounded-circle" src="{{asset('images/uploads/users').'/'.$user_coment->img}}" alt="">
                            </div>
                            <div class="col-8">
                                <h4>{{$user_coment->name}}</h4>
                                <p>{{$comentario->comentario}}</p>
                            </div>
                            <div class="col-3">
                                {!! Form::open(['route' => ['comentario.ban', $comentario->id], 'method' => 'PUT']) !!}
                                <button class="btn btn-default" type="submit">Banear</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>



    </div>

    @endsection
