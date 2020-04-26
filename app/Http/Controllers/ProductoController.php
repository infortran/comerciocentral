<?php

namespace App\Http\Controllers;

use App\Cart;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Http\Requests\ProductosFormRequest;
use App\TeamMember;
use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\File;
use App\Categoria;
use App\Marca;
use Image;
use Session;

class ProductoController extends Controller
{
    private $categorias;
    private $marcas;
    private $productos;


    public function __construct()
    {
        $this->middleware('admin');
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->productos = Producto::all();
    }

    public function index(Request $request){
        $query = trim($request->get('search'));
        if($request){
            $this->productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(5);
        }

    	return view('backend.productos.index',['productos'=>$this->productos,'search' => $query]);
    }

    //abre la vista crear producto
    public function create(){
    	return view('backend.productos.create', ['categorias' => $this->categorias, 'marcas' => $this->marcas]);
    }

    //guarda el nuevo producto en db
    public function store(Request $request){
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required|numeric|integer|max:100000'
        ]);

        $img = $request->file('img');
        $imageName = time().'.'.$img->extension();
        $imgResize = Image::make($img->path());
        $imgResize->fit(800,600, function($constraint) {
            $constraint->upsize();
        })->save(public_path('images/uploads/productos').'/'. $imageName);

        $producto = new Producto();

        $producto->nombre = request('nombre');
        $producto->descripcion = request('descripcion');
        $producto->precio = request('precio');
        $producto->img = $imageName;
        if(request('categoria')){
            $producto->id_categoria = request('categoria');
        }
        if(request('marca')){
            $producto->id_marca = request('marca');
        }

        $producto->save();

        return redirect('/admin/productos');
    }

    //muestra la vista FRONTEND PRODUCTOS
    public function show(Request $request){
        $query = trim($request->get('search'));
        if($request){
            $this->productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(9);
        }
        if(request('categoria')){
            $this->productos = Producto::where('id_categoria', request('categoria'))->orderBy('id', 'asc')->paginate(9);
        }
        if(request('marca')){
            $this->productos = Producto::where('id_marca', request('marca'))->orderBy('id', 'asc')->paginate(9);
        }
        $data = [
            'header' => HeaderFrontend::find(1),
            'footer' => FooterInfo::find(1),
            'members' => TeamMember::all(),
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
            'productos' => $this->productos,
            'search' => $query
        ];
        return view('frontend.productos', $data);
    }



    //muestra la vista editar
    public function edit($id){
        return view('backend.productos.edit', [
            'producto' => Producto::findOrFail($id),
            'categorias' => $this->categorias,
            'marcas' => $this->marcas]);
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
                if(!$producto->img == 'image.png'){
                    File::delete($img_delete);
                }
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
        if($request->get('categoria')){
            $producto->id_categoria = $request->get('categoria');
        }
        if(request('marca')){
            $producto->id_marca = request('marca');
        }


        $producto->update();

        return redirect('/admin/productos');



    }

    //eliminar un productos
    public function destroy($id){
        $producto = Producto::findOrFail($id);
        $img_delete = 'images/uploads/productos/'. $producto->img;
        if(File::exists(public_path($img_delete))) {
            if($producto->img != 'image.png'){
                File::delete($img_delete);
            }
        }
        $producto->delete();

        return redirect('/admin/productos');


    }


}
