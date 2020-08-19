<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comercio Central</title>
</head>
<style>
    @font-face {
        font-family: thino;
        src: url('fonts/thinoobold.otf');
    }
    html{
        height:100%;

    }
    body{
        margin:0;
        padding:0;
        background:linear-gradient(to bottom, #110025, #3c3b87);
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .text{
        color: #fff;
        text-shadow: 0 5px 15px rgba(255,255,255,.4);
        font-weight: bolder;
        font-family: thino;
        text-transform: uppercase;
        font-size: 60px;
        text-align: center;
    }
    .img-container{
        text-align: center;
    }
</style>
<body>
<div class="text">
    estamos construyendo el futuro
</div>
    <div class="img-container">
        <img src="{{asset('images/system/navbar-new2.png')}}" alt="">
    </div>
</body>
</html>
