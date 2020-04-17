<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use App\Producto;

class MarcaController extends Controller
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
        $marcas = Marca::all();
        if($request){
            $marcas = Marca::where('marca', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(10);
        }
        
        return view('backend.marcas.index',['marcas'=>$marcas,'search' => $query]);
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
            'marca' => 'required|max:50'
        ]);

        $marca = new Marca();

        $marca->marca = request('marca');
        
        $marca->save();

        return redirect('/admin/marcas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);
        
        $request->validate([
            'marca' => 'required|max:50'
        ]);
            
        $marca->marca = $request->get('marca');    

        $marca->update();

        return redirect('/admin/marcas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::whereIdMarca($id)->update(['id_marca' => 0]);

        $marca = Marca::findOrFail($id);
        
        $marca->delete();

        return redirect('/admin/marcas');
    }
}
