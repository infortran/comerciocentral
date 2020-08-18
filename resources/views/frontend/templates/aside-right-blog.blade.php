<div class="col-sm-3">


    <div class="left-sidebar">
        <h2 class="title">Destacadas</h2>
        @foreach($destacados as $destacado)
        <div class="noticia-destacada">

            <img class="img-responsive" src="{{ asset('images/uploads/blog').'/'.$destacado->img }}" alt="">
            <h3 class="title">{{ $destacado->titulo }}</h3>
            <div class="block-ellipsis">
                {{ $destacado->contenido }}
            </div>
            <div class="link">
                <a href="">Ver mas</a>
            </div>

        </div>

        @endforeach
    </div>
</div>
