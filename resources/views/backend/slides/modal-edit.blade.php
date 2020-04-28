{!!Form::open(['action' => ['SlideController@update', $slide->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data'])!!}

<div class="modal fade" id="modal-edit-slide{{$slide->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Editar Slide</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <div class="card">
                                <div class="card-header">
                                    Imagen principal
                                </div>
                                <img class="card-img-top" src="{{asset('images/uploads/slides').'/'.$slide->img}}" alt="">

                            </div>
                            <input type="file" name="img">
                            <small>Solo formato PNG minimo <strong> 480 x 440</strong> pixeles (fondo <strong>transparente</strong>)</small>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="col-12 col-lg-10">
                                <div class="card">
                                    <div class="card-header">
                                        Imagen Oferta
                                    </div>
                                    <img class="card-img-top" src="{{asset('images/uploads/slides').'/'.$slide->img_pricing}}" alt="">

                                </div>
                                <input type="file" name="img_pricing">
                                <small>Minimo <strong> 172x172</strong> pixeles. </small>
                            </div>
                            <hr>
                            <div class="col-12 col-lg-10" >
                                <div class="card">
                                    <div class="card-header">
                                        Logotipo
                                    </div>
                                    <img class="card-img-top" src="{{asset('images/uploads/slides').'/'.$slide->logo}}" alt="">

                                </div>
                                <input type="file" name="logo">
                                <small>Minimo <strong>200x60</strong> pixeles</small>
                            </div>
                        </div>


                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
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
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="slide-input">Titulo</label>
                                <input name="titulo" value="{{$slide->titulo}}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slide-input">Texto del boton</label>
                                <input value="{{$slide->txt_boton}}" name="txt_boton" type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="input-search-producto-slide">Seleccione producto a mostrar.</label>

                            <select class="form-control productos-list-slide-create" name="producto_id" id="" style="width: 220px">
                                <option value="{{$slide->productos->id}}">{{$slide->productos->nombre}}</option>
                                @foreach(App\Producto::all() as $producto)
                                    <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="slide-input">Texto del slide</label>
                                <textarea value="" class="form-control" name="subtitulo" id="">{{$slide->subtitulo}}</textarea>
                            </div>

                        </div>
                    </div>

                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="defaultButton" data-dismiss="modal">Cancelar</button>

                <button type="submit" class="addButton"><i class="fas fa-save"></i> Guardar</button>


            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
