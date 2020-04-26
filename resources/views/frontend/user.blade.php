@extends('frontend.templates.principal')

@section('content')
    <section>
        <div class="container">

            <div class="row" style="margin:20px 5px 120px 5px">

                <div class="col-sm-10 col-sm-offset-1">

                    <hr>
                    <div class="card" style="margin:0;padding:0;position:relative">
                        <div class="row" style="margin:0;padding:0">
                            <div class="col-sm-4 text-center" style="max-width:450px;min-height:300px;background: linear-gradient(#fcd5c1, #fdb5b5); padding:20px">
                                <img id="img-user" class="img-responsive img-circle" style="
                                max-width:200px;
                                max-height: 300px;
                                position:relative;
                                margin: 0 auto;" src="{{asset('images/uploads/users').'/'.Auth::user()->img}}" alt="">

                                <label style="display:inline-block" class="infoButton">
                                    <i class="fa fa-image"></i>
                                   <small style="font-size: 12px">Cambiar mi imagen de perfil</small>
                                    <input style="display: none" type="file">
                                </label>
                            </div>
                            <div class="col-sm-8 form-user">


                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input value="{{Auth::user()->name}}" type="text" class="form-control" placeholder="Nombre de usuario" aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-envelope"></span>
                                        </span>
                                        <input value="{{Auth::user()->email}}" type="text" class="form-control" placeholder="Correo electronico" aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="fa fa-user"></span>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                    </div>

                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-save"></i>
                                        Guardar cambios
                                    </button>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
