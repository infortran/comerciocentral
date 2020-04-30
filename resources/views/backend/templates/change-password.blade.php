@extends('backend.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <form method="POST" action="{{route('admin.changepass')}}" class="card">
                    @csrf
                    <div class="card-header">
                        Cambio de contraseña
                        <span class="badge badge-primary float-right" id="badge-countdown">0</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Ingrese su actual contraseña</label>
                            <input class="form-control" name="oldpass" type="password" placeholder="Contraseña actual">
                        </div>
                        <div class="form-group">
                            <label for="">Ingrese su nueva contraseña</label>
                            <input class="form-control" name="newpass" type="password" placeholder="Al menos 8 caracteres">
                        </div>
                        <div class="form-group">
                            <label for="">Repita su nueva contraseña</label>
                            <input class="form-control" name="repeatpass" type="password" placeholder="repita contraseña">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger" type="submit">
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
                success:function (data) {
                    alert('Has alcanzado el limite de tiempo');
                    location.href = '/admin';
                }
            });
        },30000);

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

