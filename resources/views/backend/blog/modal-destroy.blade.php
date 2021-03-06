<!-- Modal -->
<div class="modal fade" id="modal-destroy{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar un producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        Esta seguro que desea eliminar permanentemente el post N°{{$post->id}} ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


          <form action="{{ route('blog.destroy', ['domain' => $domain, $post->id]) }}" method="POST">
              @csrf
              @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fas fa-minus-circle"></i> Eliminar</button>
          </form>


      </div>
    </div>
  </div>
</div>
