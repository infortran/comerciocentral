@extends('frontend.templates.principal')

@section('content')
    <div class="container" style="margin-bottom: 50px">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form method="POST" action="{{route('user.changepass')}}" class="">
                    @csrf
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h2>Cambio de contraseña
                                <span class="badge pull-right" id="badge-countdown">0</span>
                            </h2>

                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="">Ingrese su actual contraseña</label>
                                <input class="form-control" name="oldpass" type="password" placeholder="Contraseña actual">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="">Ingrese su nueva contraseña</label>
                                <input class="form-control" name="newpass" type="password" placeholder="Al menos 8 caracteres">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="">Repita su nueva contraseña</label>
                                <input class="form-control" name="repeatpass" type="password" placeholder="repita contraseña">
                            </div>
                        </li>
                    </ul>

                    <div class="card-footer">
                        <button class="btn btn-danger pull-right" type="submit">
                            <i class="fa fa-save"></i>
                            Cambiar contraseña</button>
                    </div>


                </form>
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

@endsection


<script>
    setTimeout(function(){
        $.ajax({
            url:'reset',
            success:function () {
                alert('Has alcanzado el limite de tiempo');
                location.href = '/cuenta';
            }
        });
    },30000);

     window.onbeforeunload = function () {

         $.ajax({
             url: 'reset',
             success: function (data) {
                 alert('Tu contraseña no sera cambiada');
                 location.href = '/cuenta';
             }
         });
     }
    var timeleft = 30;
    var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            document.getElementById("badge-countdown").innerHTML = "0";
        } else {
            document.getElementById("badge-countdown").innerHTML = timeleft;
        }
        timeleft -= 1;
    }, 1000);
</script>

