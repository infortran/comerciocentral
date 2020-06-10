<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="{{ asset('css/bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        html{
            height: 100%;
        }
        body{
            background-size: cover;
            background: linear-gradient(to bottom, #22007a, #8f30b6);
            background-repeat: no-repeat;
            height:100%;
        }

        .login input{
            border-radius: 50px;
            padding:25px 20px;
            background: rgba(0,0,0,.2);
            color:#fff;
        }
        .login input::placeholder{
            color: #d0a2ff;
        }

        .login input:focus{
            background:rgba(255,255,255,.4);
            color: #37004e;
        }
        .card{
            margin: 50px 0;
            background:rgba(255,255,255,.2);
            color: #fff;
        }

        .link-login{
            color: #420063;
        }
        .link-login:hover{
            color: #510041;
        }

        .btn-hover {
            width: 80%;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            margin: 0;
            height: 55px;
            text-align:center;
            border: none;
            background-size: 300% 100%;

            border-radius: 50px;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .btn-hover:hover {
            background-position: 100% 0;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .btn-hover:focus {
            outline: none;
        }

        .btn-hover.color-12 {
            background-image: linear-gradient(to right, #0060eb, #5000f1, #659dff, #a26dff);  box-shadow: 0 5px 15px rgba(242, 97, 103, .4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-6 mx-auto">
                <form action="{{ route('main.login.auth') }}" class="card" method="POST">
                    @csrf
                    <div class="card-header text-center">
                        <img class="mx-auto" src="{{ asset('images/system/navbar.png') }}" alt="">
                    </div>


                    <div class="card-body login text-center">
                        <h2>Ingresar</h2>
                        <hr>
                        <input name="email" class="form-control" type="text" placeholder="Correo electronico">
                        <br>
                        <input name="password" class="form-control" type="password" placeholder="Contraseña">
                        <br>
                        <input name="remember" type="checkbox">
                        <label for="">Mantener mi sesion iniciada</label>
                        <br>
                        <a class="link-login" href="">Olvide mi contraseña?</a>
                        <hr>
                        <button type="submit" class="btn-hover color-12">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>