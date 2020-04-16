<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
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
        $categorias = Categoria::all();
        if($request){
            $categorias = Categoria::where('categoria', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(10);
        }
        
        return view('backend.categorias.index',['categorias'=>$categorias,'search' => $query]);
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
            'categoria' => 'required|max:50'
        ]);

        $categoria = new Categoria();

        $categoria->categoria = request('categoria');
        
        $categoria->save();

        return redirect('/admin/categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        
        $request->validate([
            'categoria' => 'required|max:50'
        ]);
            
        $categoria->categoria = $request->get('categoria');    

        $categoria->update();

        return redirect('/admin/categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        
        $categoria->delete();

        return redirect('/admin/categorias');
    }
}
