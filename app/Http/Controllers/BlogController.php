<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Comentario;
use App\Loader;
use App\Marca;
use App\Post;
use App\Producto;
use App\SiteSocial;
use App\User;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\FooterInfo;
use App\TeamMember;

class BlogController extends Controller
{
    public function index(Request $request, $domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $data['posts'] = Post::where('tienda_id', $data['tienda']->id)->orderBy('id','DESC')->paginate(5);
                $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id)->get();
                $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id)->get();
                return view('frontend.blog.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function show($domain, $id){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $post = Post::findOrFail($id);
                $data['post'] = $post;
                $data['user_post'] = User::findOrFail($post->id_usuario);
                $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id)->get();
                $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id)->get();

                $data['comentarios'] = Comentario::where('id_post', $post->id)->get();


                return view('frontend.blog.blog-single',$data);
            }
        }
        return view('frontend.templates.site-not-found');

    }

}
