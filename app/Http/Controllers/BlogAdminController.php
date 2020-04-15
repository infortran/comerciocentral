<?php

namespace App\Http\Controllers;

use App\BlogAdmin;
use Illuminate\Http\Request;
use App\Post;

class BlogAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('backend.blog.index', ['posts' => $posts]);
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
        $imgResize->fit(200,100, function($constraint) {
            $constraint->upsize();
        })->save(public_path('images/uploads/blog').'/'. $imageName);

        $post = new Post();

        $post->titulo = request('titulo');
        $post->contenido = request('contenido');
        $post->img = $imageName;

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
    public function edit(BlogAdmin $blogAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogAdmin $blogAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogAdmin  $blogAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogAdmin $blogAdmin)
    {
        //
    }
}
