<?php

namespace App\Http\Controllers;

use App\BlogAdmin;
use App\Comentario;
use App\HeaderFrontend;
use App\Loader;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BlogAdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $domain)
    {
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $data = $loader->getData();
                $id = $data['tienda']->id;
                $query = trim($request->get('search'));
                if($request){
                    $posts = Post::where('tienda_id',$id )->where('titulo', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(3);
                }
                $data['posts'] = $posts;
                $data['search'] = $query;
                return view('backend.blog.index', $data);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($domain)
    {
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                return view('backend.blog.create', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $domain)
    {
        if($domain){
            $loader = new Loader($domain);
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                $tienda = $data['tienda'];
                $request->validate([
                    'titulo' => 'required|max:50',
                    'contenido' => 'required',
                    'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=500,min_height=500']);
                $img = $request->file('img');
                $imageName = time().'.'.$img->extension();
                $imgResize = Image::make($img->path());
                $imgResize->fit(847,392, function($constraint) {
                    $constraint->upsize();
                })->save(public_path('images/uploads/blog').'/'. $imageName);
                $post = new Post();
                $post->titulo = request('titulo');
                $post->contenido = request('contenido');
                $post->img = $imageName;
                $post->user_id = Auth::user()->id;
                $tienda->posts()->save($post);
                return redirect('/admin/blog');
            }
        }
        return view('frontend.templates.site-not-found');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $domain, $id)
    {
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $data = $loader->getData();
                $post = Post::findOrFail($id);
                $data['post'] = $post;
                $data['user_post'] = User::findOrFail($post->users->id);
                $data['comentarios'] = Comentario::where('id_post', $post->id)->get();
                return view('backend.blog.post', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $domain ,$id)
    {
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                $post = Post::findOrFail($id);
                $data['post'] = $post;
                return view('backend.blog.edit', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $domain, $id)
    {
        $post = Post::findOrFail($id);
        if($request->img){
            $request->validate([
                'titulo' => 'required|max:50',
                'contenido' => 'required',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=960,min_height=720']);
            $img = $request->file('img');
            $imageName = time().'.'.$img->extension();
            $imgResize = Image::make($img->path());
            $imgResize->fit(847,392, function($constraint) {
                $constraint->upsize();
            })->save(public_path('images/uploads/blog').'/'. $imageName);
            $post->img = $imageName;
        }else{
            $request->validate([
                'titulo' => 'required|max:50',
                'contenido' => 'required']);
        }
        $post->titulo = request('titulo');
        $post->contenido = request('contenido');
        $post->update();
        return redirect('/admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $domain, $id)
    {
        $post = Post::findOrFail($id);
        $img_delete = 'images/uploads/blog/'. $post->img;
        if(File::exists(public_path($img_delete))) {
            File::delete($img_delete);
        }
        $post->delete();

        return redirect('/admin/blog');
    }
}
