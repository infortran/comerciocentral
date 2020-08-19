<div class="col-sm-3">


    <div class="left-sidebar">
        <h2 class="title">Publicidad</h2>

        <div class="shipping text-center banner-aside" style="background: linear-gradient(to bottom, {{ $tienda->asidebanner->color_princ_a ?? '' }}, {{ $tienda->asidebanner->color_princ_b ?? ''}});"><!--aside banner-->
            <div class="row banner-aside-a"  style="background-image: url('{{ asset('images/uploads/productos').'/'.($tienda->asidebanner->producto->img ?? '')}}')">
                <div class="dscto-banner-aside">
                    {{ $tienda->asidebanner->dscto ?? ''}}
                </div>

            </div>
            <div class="row banner-aside-b">
                <svg class="svg content-banner-aside-b" width="100%" height="100px">
                    <defs>
                        <linearGradient id="gradBannerAside" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:{{ $tienda->asidebanner->color_sec_a ?? ''}};stop-opacity:1" />
                            <stop offset="100%" style="stop-color:{{ $tienda->asidebanner->color_sec_b ?? ''}};stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <rect width="100%" height="100px" style="fill: url(#gradBannerAside)"></rect>
                </svg>
                <a href="{{ url('producto').'/'. ($tienda->asidebanner->producto->id ?? '')}}" class="btn btn-primary btn-banner-aside">{{$tienda->asidebanner->btn ?? ''}}</a>
            </div>
        </div><!--/aside banner-->
    </div>
</div>