@extends('frontend.templates.principal')

@section('content')
    <section>
        <div class="container">

            <div class="row" style="margin:20px 5px 120px 5px">

                <div class="col-sm-10 col-sm-offset-1">
                    <h2>Bienvenido {{Auth::user()->name}}</h2>
                    <hr>
                    <div class="card" style="margin:0;padding:0;position:relative">
                        <div class="row">
                            <div class="col-sm-4">
                                <img id="img-user" class="img-responsive" style="max-width:300px;max-height: 400px;position:relative" src="{{asset('images/uploads/users').'/'.Auth::user()->img}}" alt="">

                                <label style="position: absolute; bottom: 20px;left:35px" class="infoButton">
                                    <i class="fa fa-image"></i>
                                   <small style="font-size: 12px">Cambiar mi imagen de perfil</small>
                                    <input style="display: none" type="file">
                                </label>
                            </div>
                            <div class="col-sm-8">
                                <form class="form" action="">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">@</span>
                                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
