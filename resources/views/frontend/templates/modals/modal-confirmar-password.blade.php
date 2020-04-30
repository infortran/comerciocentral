<!-- Modal -->
{!! Form::open(['route' => 'user.check.pass']) !!}
<div class="modal fade" id="modal-confirmar-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirme su contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Por favor ingrese su contraseña actual para confirmar</p>
                <input type="password" class="form-control" name="oldpass">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-arrow-circle-right"></i>
                    Continuar</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
