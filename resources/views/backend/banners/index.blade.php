@extends('backend.layout')

@section('content')
    <div class="container">
        <h1>Publicidad</h1>
        <div class="row">
            <div class="col-lg-9">
                <p>Tus productos más importantes necesitan un lugar destacado en tu tienda. Destaca tus mejores productos ofreciendo descuentos y ofertas
                    para que tus clientes quieran volver a visitar tu tienda en busca de buenas ofertas.</p>
            </div>
        </div>

        <form action="{{ url('admin/banners/aside') }}" method="POST" class="row" style="margin-top:10px">
            @csrf
            <div class="col-lg-2">
                <h5><strong>Lateral</strong></h5>
                <p>Publicidad ubicada en el costado izquierdo de tu sitio</p>
            </div>
            <div class="col-lg-10 banner-editor">
                <div class="row">
                    <div class="col-sm-8">
                        <input name="tienda" type="hidden" value="{{ $tienda->id }}">
                        <div class="form-group">
                            <input name="dscto" type="text" class="form-control" placeholder="Oferta" value="{{ $tienda->asidebanner->dscto ?? ''}}">
                        </div>
                        <div class="form-group">
                            <input name="btn" type="text" class="form-control" placeholder="Texto del boton" value="{{ $tienda->asidebanner->btn ?? ''}}">
                        </div>
                        <div class="form-group">
                            <select name="producto" id="" class="form-control">
                                @foreach($tienda->productos as $producto)
                                <option value="{{$producto->id}}" {{ $producto->id == ($tienda->asidebanner->producto->id ?? '') ? 'selected' :'' }}>
                                    {{$producto->nombre}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="form-group">
                                    <label for="">Color fondo principal</label>
                                    <div>
                                        <input name="color-princ-a" type="color" value="{{ $tienda->asidebanner->color_princ_a ?? '' }}">
                                        <input name="color-princ-b" type="color" value="{{ $tienda->asidebanner->color_princ_b ?? '' }}">
                                    </div>

                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group">
                                    <label for="">Color inferior</label>
                                    <div>
                                        <input name="color-sec-a" type="color" value="{{ $tienda->asidebanner->color_sec_a ?? ''}}">
                                        <input name="color-sec-b" type="color" value="{{ $tienda->asidebanner->color_sec_b ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>

                <button class="btn btn-comerciocentral" type="submit">Guardar cambios</button>
            </div>
        </form>
        <hr>
        <form action="{{ url('admin/banners/productos') }}" method="POST" class="row" style="margin-top:10px">
            @csrf
            <div class="col-lg-2">
                <h5><strong>Página Productos</strong></h5>
                <p>Publicidad ubicada en la pagina principal de productos</p>
            </div>
            <div class="col-lg-10 banner-editor">
                <div class="row">
                    <div class="col-sm-8">
                        <input name="tienda" type="hidden" value="{{ $tienda->id }}">
                        <div class="form-group">
                            <input type="text" name="titulo" class="form-control" placeholder="Titulo del banner" value="{{ $tienda->productobanner->titulo ?? '' }}">

                        </div>
                        <div class="form-group">
                            <input type="text" name="txt1" class="form-control" placeholder="Texto secundario" value="{{ $tienda->productobanner->txt1 ?? '' }}">

                        </div>
                        <div class="form-group">
                            <input type="text" name="txt2" class="form-control" placeholder="Texto primario" value="{{ $tienda->productobanner->txt2 ?? '' }}">

                        </div>
                        <div class="form-group">
                            <input name="dscto" type="text" class="form-control" placeholder="Oferta" value="{{ $tienda->productobanner->dscto ?? '' }}">
                        </div>
                        <div class="form-group">
                            <input name="btn" type="text" class="form-control" placeholder="Texto del boton" value="{{ $tienda->productobanner->btn ?? '' }}">
                        </div>
                        <div class="form-group">
                            <select name="producto" id="" class="form-control">
                                @foreach($tienda->productos as $producto)
                                    <option value="{{$producto->id}}" {{ $producto->id == ($tienda->productobanner->producto->id ?? '') ? 'selected' :'' }}>{{$producto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="form-group">
                                    <label for="">Color del Texto</label>
                                    <div><span>Titulo</span>   &nbsp;&nbsp;<span>Texto</span></div>
                                    <div>
                                        <input name="color-titulo" type="color" value="{{ $tienda->productobanner->color_titulo ?? '' }}">
                                        <input name="color-texto" type="color" value="{{ $tienda->productobanner->color_texto ?? '' }}">
                                    </div>

                                </div>
                            </div>

                            <div class="list-group-item">
                                <div class="form-group">
                                    <label for="">Color fondo texto</label>
                                    <div>
                                        <input name="color-bg-a1" type="color" value="{{ $tienda->productobanner->color_bg_a1 ?? '' }}">
                                        <input name="color-bg-a2" type="color" value="{{ $tienda->productobanner->color_bg_a2 ?? '' }}">
                                    </div>

                                </div>
                            </div>

                            <div class="list-group-item">
                                <div class="form-group">
                                    <label for="">Color fondo imagen</label>
                                    <div>
                                        <input name="color-bg-b1" type="color" value="{{ $tienda->productobanner->color_bg_b1 ?? ''}}">
                                        <input name="color-bg-b2" type="color" value="{{ $tienda->productobanner->color_bg_b2 ?? ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item">
                                <div class="form-group">
                                    <label for="">Marca del producto</label>
                                    <img style=" height: 40px;display: block" src="{{ asset('images/uploads/marcas').'/'.($tienda->productobanner->img ?? 'logo.jpg') }}" alt="">
                                    <input type="file" name="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-comerciocentral" type="submit">Guardar cambios</button>
            </div>
        </form>
    </div>
    @endsection
