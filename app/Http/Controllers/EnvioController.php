<?php

namespace App\Http\Controllers;

use App\Envio;
use Illuminate\Http\Request;

class EnvioController extends Controller
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
    public function store(Request $request, $domain)
    {
        $request->validate([
            'descripcion' => 'required|min:5|max:255',
            'precio' => 'required|numeric'
        ]);
        $envio = new Envio();
        $envio->tienda_id = request('tienda');
        $envio->descripcion = request('descripcion');
        $envio->precio = request('precio');
        $envio->min_price = request('min_price');
        $envio->max_price = request('max_price');
        $envio->save();
        return redirect('/admin/config/main');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show(Envio $envio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Envio $envio)
    {
        $request->validate([
            'descripcion' => request('descripcion'),
            'precio' => request('precio')
        ]);

        $envio->descripcion = request('descripcion');
        $envio->precio = request('precio');
        $envio->min_price = request('min_price');
        $envio->max_price = request('max_price');
        $envio->update();
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio)
    {
        $envio->delete();
        return redirect('/admin');
    }
}
