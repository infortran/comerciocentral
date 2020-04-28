
<!-- Modal -->
{!! Form::open(['route' => 'user.addDireccion']) !!}
<div class="modal fade" id="modal-add-direccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar una nueva direccion</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="calle" placeholder="Calle">
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="numero" placeholder="Numero. ej: #123">

                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="departamento" placeholder="Departamento. ej: #12">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="poblacion" placeholder="Poblacion">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="ciudad" placeholder="Ciudad">
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i>
                    Guardar</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
