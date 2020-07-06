<?php

namespace App\Http\Controllers;

use App\Cart;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Http\Requests\ProductosFormRequest;
use App\Loader;
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
    private $data;


    public function __construct()
    {
        /*$this->middleware('admin');
        $loader = new Loader();
        $this->data = $loader->getData();
        $this->data['categorias'] = Categoria::all();
        $this->data['marcas'] = Marca::all();
        $this->data['productos'] = Producto::all();*/

    }

    public function index(Request $request){
        //dd('que pasa');
        $domain = request()->route('domain');
        ($domain);
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $data = $loader->getData();

                $id = $data['tienda']->id;
                $query = trim($request->get('search'));
                if($request){
                    $data['productos'] = Producto::where('tienda_id', $id)->where('nombre', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(5);
                }
                $data['search'] = $query;
                return view('backend.productos.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    //abre la vista crear producto
    public function create(){
        $domain = request()->route('domain');
        ($domain);
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $data = $loader->getData();
                $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id)->get();
                $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id)->get();
                return view('backend.productos.create',$data);
            }
        }

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



    //muestra la vista editar
    public function edit($id){
        $this->data['producto'] = Producto::find($id);
        return view('backend.productos.edit', $this->data);
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

    public function setNotAvailable($id){
        $producto = Producto::find($id);
        $producto->is_available = false;
        $producto->save();
        return redirect('admin/productos');
    }

    public function setAvailable($id){
        $producto = Producto::find($id);
        $producto->is_available = true;
        $producto->save();
        return redirect('admin/productos');
    }


}
