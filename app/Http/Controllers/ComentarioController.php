<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\ComentarioProducto;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function cProductoStore(Request $request)
    {
        $request->validate([
           'comentario' => 'required|max:500|regex:[A-Za-z1-9 ]'
        ]);
        $comentario = new Comentario();

        $comentario->user_id = Auth::user()->id;
        $comentario->comentario = request('comentario');

        $comentario->save();
        $cp = new ComentarioProducto();
        $cp->comentario_id = $comentario->id;
        $cp->producto_id = request('producto');
        $cp->save();

        $redirect = '/noticias/post/' . $request->get('id_post');

        return redirect($redirect);
    }

    public function cProductoUpdate(Request $request, $domain, $id){
        $comentario = Comentario::findOrFail($id);
        $request->validate([
            'comentario' => 'required|max:500|regex:[A-Za-z1-9 ]'
        ]);
        $comentario->comentario = request('comentario');
        $comentario->update();
        $redirect = '/producto/' . $comentario->comentarioproducto->producto->id . '#comentario-header';
        return redirect($redirect);
    }
    public function cProductoDestroy(Request $request, $domain, $id){
        $comentarioproducto = ComentarioProducto::findOrFail($id);
        $comentario = $comentarioproducto->comentario;
        $producto = $comentarioproducto->producto;
        $comentario->delete();
        $comentarioproducto->delete();
        $redirect = '/producto/' . $producto->id . '#comentario-header';
        return redirect($redirect);

    }

    public function cPostStore(Request $request){
        $request->validate([
            'comentario' => 'required|max:500|regex:[A-Za-z1-9 ]'
        ]);
        $comentario = new Comentario();

        $comentario->user_id = Auth::user()->id;
        $comentario->comentario = request('comentario');

        $comentario->save();
        $cp = new ComentarioPost();
        $cp->comentario_id = $comentario->id;
        $cp->post_id = request('post');
        $cp->save();

        $redirect = '/noticias/post/' . $request->get('post') .'#header-comentario';

        return redirect($redirect);
    }

    public function cPostUpdate(Request $request, $domain, $id){
        $comentario = Comentario::findOrFail($id);
        $request->validate([
            'comentario' => 'required|max:500|regex:[A-Za-z1-9 ]'
        ]);
        $comentario->comentario = request('comentario');
        $comentario->update();
        $redirect = '/noticias/post/' . $request->get('post') .'#header-comentario';
        return redirect($redirect);
    }

    public function cPostDestroy(Request $request, $domain, $id){
        $comentariopost = ComentarioProducto::findOrFail($id);
        $comentario = $comentariopost->comentario;
        $producto = $comentariopost->producto;
        $comentario->delete();
        $comentariopost->delete();
        $redirect = '/producto/' . $producto->id . '#comentario-header';
        return redirect($redirect);
    }

    public function ban($id){
        $comentario = Comentario::findOrFail($id);
        $comentario->banned = true;
        $comentario->update();
        return redirect()->back();
    }

    public function unlock($id){
        $comentario = Comentario::findOrFail($id);
        $comentario->banned = false;
        $comentario->update();
        return redirect()->back();
    }
}
