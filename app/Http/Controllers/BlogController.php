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
    public function index(Request $request){
        /*$query = trim($request->get('search'));
        $posts = Post::all();
        if($request){
            $posts = Post::where('titulo', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(5);
        }
        $data = [
            'header' => HeaderFrontend::findOrFail(1),
            'footer' => FooterInfo::findOrFail(1),
            'members' => TeamMember::all(),
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
            'search' => $query,
            'posts' => $posts,
            'siteSocials' => SiteSocial::all()
        ];

    	return view('frontend.blog.index',$data);*/
        $domain = request()->route('domain');
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $data['posts'] = Post::where('tienda_id', $data['tienda']->id)->get();
                $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id)->get();
                $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id)->get();
                return view('frontend.blog.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function show($id){
        $post = Post::findOrFail($id);
        $data = [
            'header' => HeaderFrontend::findOrFail(1),
            'footer' => FooterInfo::findOrFail(1),
            'members' => TeamMember::all(),
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
            'post' => $post,
            'siteSocials' => SiteSocial::all(),
            'user_post' => User::findOrFail($post->id_usuario),
            'comentarios' => Comentario::where('id_post', $post->id)->get()
        ];

    	return view('frontend.blog.blog-single',$data);
    }

}
