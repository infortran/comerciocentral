<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
           'comentario' => 'required|max:500'
        ]);
        $comentario = new Comentario();

        $comentario->id_user = request('id_user');
        $comentario->id_post = request('id_post');
        $comentario->comentario = request('comentario');

        $comentario->save();

        $redirect = '/blog/post/' . $request->get('id_post');

        return redirect($redirect);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        //
    }

    public function ban($id){
        $comentario = Comentario::find($id);
        $comentario->banned = true;
        $comentario->update();
        return redirect()->back();
    }

    public function unlock($id){
        $comentario = Comentario::find($id);
        $comentario->banned = false;
        $comentario->update();
        return redirect()->back();
    }
}
