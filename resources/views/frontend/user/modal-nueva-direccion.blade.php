<form class="modal fade" id="modal-nueva-direccion" tabindex="-1" role="dialog" aria-labelledby="ModalNuevaDireccion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar una nueva direccion</h5>
            </div>
            <div class="modal-body text-center modal-dir-user">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Calle">
                    <input type="text" class="form-control" placeholder="Numero">
                    <input type="text" class="form-control" placeholder="Depto">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Poblacion/Villa">
                    <select class="form-control" name="tipo">
                        <option disabled selected>Tipo</option>
                        <option value="">Casa</option>
                        <option value="">Departamento</option>
                        <option value="">Oficina</option>
                        <option value="">Trabajo</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="ciudad" class="form-control">
                        <option value="">San Felipe</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer text-center" style="text-align: center !important; border-top:none !important">
                <button type="submit" class="btn btn-comerciocentral-dark">Guardar</button>
                <button type="button" class="btn btn-comerciocentral" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</form>