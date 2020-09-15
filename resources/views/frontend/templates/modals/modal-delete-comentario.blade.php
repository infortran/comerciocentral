<div class="modal fade" id="modal-delete-comentario-{{$productocomentario->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div style="width:300px" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none !important">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="display:flex;align-items: center" class="modal-title" id="myModalLabel">
                    <div style="position:relative;margin-right: 20px">
                        <div style="width:50px;height:50px;
                        background:#c40000;box-shadow: 1px 1px 3px rgba(0,0,0,.4);
                        border-radius: 50%;position:relative"></div>
                        <i class="fa fa-trash" style="position:absolute;font-size:25px;top:22%;left:29%;color:#ffffff"></i>
                    </div>

                    Eliminar comentario
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px;text-align: center">
                <div>Deseas eliminar este comentario?</div>
                <small style="font-size: 12px">Esta accion no se puede deshacer <br>
                    <a data-trigger="focus" class="btn-link" data-placement="top" data-toggle="popover" tabindex="0" role="button" data-content="Solo puedes votar por un producto una vez que lo has comprado,
                    por lo tanto, si eliminas tu comentario, deberas volver a comprar el producto para dar tu opinion"
                    >Mas informacion</a></small>
            </div>
            <form method="POST" action="{{route('comentario.producto.destroy', [$domain, $productocomentario->id])}}" class="modal-footer text-center" style="text-align: center !important; border-top:none !important">
                @csrf
                @method('DELETE')
                <button style="padding:15px 35px !important;background:#a30000 !important" type="submit" class="btn btn-comerciocentral">Eliminar</button>
                <button style="padding:15px 35px !important" type="button" class="btn btn-comerciocentral" data-dismiss="modal">Cerrar</button>
            </form>
        </div>
    </div>
</div>
