<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Marca;
use App\Post;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\FooterInfo;
use App\TeamMember;

class BlogController extends Controller
{
    public function index(Request $request){
        $query = trim($request->get('search'));
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
            'posts' => $posts
        ];

    	return view('frontend.blog.index',$data);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        $data = [
            'header' => HeaderFrontend::findOrFail(1),
            'footer' => FooterInfo::findOrFail(1),
            'members' => TeamMember::all(),
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
            'posts' => $post
        ];

    	return view('frontend.blog.blog-single', $data);
    }

}
