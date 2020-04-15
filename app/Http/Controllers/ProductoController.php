<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductosFormRequest;
use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Request $request){
        $query = trim($request->get('search'));
        $productos = Producto::all();
        if($request){
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(5);
        }
    	
    	return view('backend.productos.index',['productos'=>$productos,'search' => $query]);
    }

    //abre la vista crear producto
    public function create(){
    	return view('backend.productos.create');
    }
    //guarda el nuevo producto en db
    public function store(Request $request){
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required|numeric|integer|max:100000'
        ]);
  
        $imageName = time().'.'.$request->img->extension();  
   
        $request->img->move(public_path('images/uploads/productos'), $imageName);

        $producto = new Producto();

        $producto->nombre = request('nombre');
        $producto->descripcion = request('descripcion');
        $producto->precio = request('precio');
        $producto->img = $imageName;

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
        $producto = Producto::findOrFail($id);
        
        if($request->img){
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'nombre' => 'required|max:255',
                'descripcion' => 'required|max:255',
                'precio' => 'required'
            ]);
            $imageName = time().'.'.$request->img->extension();  
   
            $request->img->move(public_path('images/uploads/productos'), $imageName);

            $img_delete = 'images/uploads/productos/'. $producto->img;
            if(File::exists(public_path($img_delete))) {
                File::delete($img_delete);
            }
            $producto->img = $imageName;
        }else{
            $request->validate([
                'nombre' => 'required|max:255',
                'descripcion' => 'required|max:255',
                'precio' => 'required'
            ]);
        }

        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');
        

        $producto->update();

        return redirect('/admin/productos');


        
    }

    //eliminar un productos
    public function destroy($id){
        $producto = Producto::findOrFail($id);
        $img_delete = 'images/uploads/productos/'. $producto->img;
        if(File::exists(public_path($img_delete))) {
            File::delete($img_delete);
        }
        $producto->delete();

        return redirect('/admin/productos');
    }

    public function uploadImageProducto(){

    }
}
