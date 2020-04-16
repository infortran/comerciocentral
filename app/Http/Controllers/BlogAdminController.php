<?php

namespace App\Http\Controllers;

use App\BlogAdmin;
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
    public function index(Request $request)
    {
        $query = trim($request->get('search'));
        $posts = Post::all();
        if($request){
            $posts = Post::where('titulo', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(3);
        }
        return view('backend.blog.index', ['posts' => $posts, 'search' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create',['textarea' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:50',
            'contenido' => 'required|max:500',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=960,min_height=720']);
        $img = $request->file('img');
        $imageName = time().'.'.$img->extension();  
        $imgResize = Image::make($img->path());
        $imgResize->fit(960,720, function($constraint) {
            $constraint->upsize();
        })->save(public_path('images/uploads/blog').'/'. $imageName);
        $post = new Post();
        $post->titulo = request('titulo');
        $post->contenido = request('contenido');
        $post->img = $imageName;
        $post->id_usuario = Auth::user()->id;
        $post->save();
        return redirect('/admin/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(BlogAdmin $blogAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.blog.edit',['post' => Post::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if($request->img){
            $request->validate([
                'titulo' => 'required|max:50',
                'contenido' => 'required|max:500',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=960,min_height=720']);

            $img = $request->file('img');
      
            $imageName = time().'.'.$img->extension();  

            $imgResize = Image::make($img->path());
            $imgResize->fit(960,720, function($constraint) {
                $constraint->upsize();
            })->save(public_path('images/uploads/blog').'/'. $imageName);
             $post->img = $imageName;
        }else{
            $request->validate([
                'titulo' => 'required|max:50',
                'contenido' => 'required|max:500']);
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
    public function destroy($id)
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
