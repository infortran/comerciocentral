<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index(){
    	$productos = Producto::all();
    	return view('backend.productos.index',['productos'=>$productos]);
    }

    //abre la vista crear producto
    public function create(){
    	return view('backend.productos.create');
    }
    //guarda el nuevo producto en db
    public function store(Request $request){
        $producto = new Producto();

        $producto->nombre = request('nombre');
        $producto->descripcion = request('descripcion');
        $producto->precio = request('precio');

        $producto->save();

        return redirect('/admin/productos');
    }

    //muestra un producto
    public function show(){

    }

    //muestra la vista editar
    public function edit($id){
        return view('backend.productos.edit', ['producto' => Producto::findOrFail($id)]);
    }
    //edita y guarda el registro en db
    public function update(Request $request, $id){
        $producto = new Producto();

        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');

        $producto->update();

        return redirect('/admin/productos');
    }

    //eliminar un productos
    public function destroy(){

    }
}
