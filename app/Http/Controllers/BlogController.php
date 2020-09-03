<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Comentario;
use App\Loader;
use App\Marca;
use App\Post;
use App\PostRating;
use App\Producto;
use App\Rating;
use App\SiteSocial;
use App\User;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\FooterInfo;
use App\TeamMember;
use Auth;

class BlogController extends Controller
{
    public function index(Request $request, $domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $query = trim($request->get('search'));
                $data['posts'] = $data['tienda']->posts()->where('titulo', 'LIKE', '%'.$query.'%')
                    ->orderBy('id','DESC')->paginate(5);
                $data['destacados'] = $data['tienda']->posts()->where('destacado', true)->paginate(3);
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
                $data['ha_votado'] = false;
                $data['promedio'] = $this->promedio($post);
                if(Auth::check()){
                    foreach($post->postRatings as $rating){
                        if($rating->rating->user == Auth::user()){
                            $data['ha_votado'] = true;
                        }
                    }
                }
                return view('frontend.blog.blog-single',$data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public static function promedio($post){
        $suma = 0;
        foreach($post->postRatings as $rating){
            $suma += $rating->rating->voto;
        }
        if(count($post->postRatings) > 0){
            return $suma / count($post->postRatings);
        }
        return 0;
    }

    public function votarNoticia(Request $request, $domain, $noticia, $voto){
        if($request->ajax()){
            $rating = new Rating();
            $rating->user_id = Auth::user()->id;
            $rating->voto = $voto;
            $rating->save();

            $postrating = new PostRating();
            $postrating->rating_id = $rating->id;
            $postrating->post_id = $noticia;
            $postrating->save();

            return true;
        }
        return view('frontend.templates.site-not-found');
    }

}
