<?php

namespace App\Http\Controllers;

use App\Cart;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Http\Requests\ProductosFormRequest;
use App\Loader;
use App\TeamMember;
use App\Tienda;
use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\File;
use App\Categoria;
use App\Marca;
use Image;
use Session;

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request, $domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                $query = trim($request->get('search'));
                if($request){
                    $data['productos'] = $data['tienda']->productos()->where('nombre', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(5);
                }
                $data['search'] = $query;
                return view('backend.productos.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    //abre la vista crear producto
    public function create($domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                return view('backend.productos.create',$data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    //guarda el nuevo producto en db
    public function store(Request $request, $domain){
        $tienda = Tienda::findOrFail($request->get('tienda'));
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nombre' => 'required|max:255|regex:[A-Za-z1-9 ]',
            'descripcion' => 'required|max:255|regex:[A-Za-z1-9 ]',
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
            $producto->categoria_id = request('categoria');
        }
        if(request('marca')){
            $producto->marca_id = request('marca');
        }

        $tienda->productos()->save($producto);

        return redirect('/admin/productos');
    }



    //muestra la vista editar
    public function edit(Request $request, $domain, $id){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominio()){
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $data['producto'] = Producto::find($id);
                return view('backend.productos.edit', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }
    //edita y guarda el registro en db
    public function update(Request $request,$domain, $id){
        $producto = Producto::findOrFail($id);

        if($request->img){
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'nombre' => 'required|max:255|regex:[A-Za-z1-9 ]',
                'descripcion' => 'required|max:255|regex:[A-Za-z1-9 ]',
                'precio' => 'required'
            ]);

            $img = $request->file('img');
            $imageName = time().'.'.$img->extension();
            $imgResize = Image::make($img->path());
            $imgResize->fit(800,600, function($constraint) {
                $constraint->upsize();
            })->save(public_path('images/uploads/productos').'/'. $imageName);

            $img_delete = 'images/uploads/productos/'. $producto->img;
            if(File::exists(public_path($img_delete))) {
                if($producto->img != 'image.png'){
                    File::delete($img_delete);
                }
            }
            $producto->img = $imageName;
        }else{
            $request->validate([
                'nombre' => 'required|max:255|regex:[A-Za-z1-9 ]',
                'descripcion' => 'required|max:255|regex:[A-Za-z1-9 ]',
                'precio' => 'required'
            ]);
        }

        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');

        $producto->precio = $request->get('precio');
        if($request->get('categoria')){
            $producto->categoria_id = $request->get('categoria');
        }
        if(request('marca')){
            $producto->marca_id = request('marca');
        }


        $producto->update();

        return redirect('/admin/productos');

    }

    //eliminar un productos
    public function destroy($domain, $id){
        $producto = Producto::findOrFail($id);
        $img_delete = 'images/uploads/productos/'. $producto->img;
        if(File::exists(public_path($img_delete))) {
            if($producto->img != 'image.png'){
                File::delete($img_delete);
            }
        }
        if($producto->slide){
            $producto->slide->delete();
        }
        if($producto->productobanner){
            $producto->productobanner->producto_id = null;
        }
        $producto->delete();

        return redirect('/admin/productos');
    }

    public function setAvailability($domain, $id){
        $producto = Producto::find($id);
        $producto->is_available = $producto->is_available ? false : true;
        $producto->save();
        return redirect('admin/productos');
    }


}
