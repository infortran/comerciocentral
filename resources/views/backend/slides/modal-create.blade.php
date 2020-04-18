{!!Form::open(['url' => 'admin/slides', 'enctype' => 'multipart/form-data'])!!}
<!-- Modal -->
<div class="modal fade" id="modal-create-slide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Crear nuevo Slide</h2>
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
                                <img id="img-create-main-slide" class="card-img-top" src="{{asset('images/semantic/image.png')}}" alt="">

                            </div>
                            <input type="file" name="img" id="input-img-create-main-slide">
                            <small>Solo formato PNG minimo <strong> 480 x 440</strong> pixeles (fondo <strong>transparente</strong>)</small>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="col-12 col-lg-10">
                                <div class="card">
                                    <div class="card-header">
                                        Imagen Oferta
                                    </div>
                                    <img id="img-create-pricing-slide" class="card-img-top" src="{{asset('images/semantic/image.png')}}" alt="">

                                </div>
                                <input type="file" name="img_pricing" id="input-img-create-pricing-slide">
                                <small>Minimo <strong> 172x172</strong> pixeles. </small>
                            </div>
                            <hr>
                            <div class="col-12 col-lg-10" >
                                <div class="card">
                                    <div class="card-header">
                                        Logotipo
                                    </div>
                                    <img id="img-create-logo-slide" class="card-img-top" src="{{asset('images/semantic/wide.jpg')}}" alt="">

                                </div>
                                <input type="file" name="logo" id="input-img-create-logo-slide">
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="slide-input">Titulo</label>
                                <input name="titulo" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="slide-input">Texto del boton</label>
                                <input name="txt_boton" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="slide-input">Texto del slide</label>
                                <textarea class="form-control" name="subtitulo"></textarea>
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
