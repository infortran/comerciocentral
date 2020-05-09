<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Loader;
use Illuminate\Http\Request;
use App\Producto;
//use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    private $data;
    public function __construct(){
        $this->middleware('admin');
        $loader = new Loader();
        $this->data = $loader->getData();
        $this->data['categorias'] = Categoria::all();
    }

    public function index(Request $request)
    {
        $query = trim($request->get('search'));
        if($request){
            $this->data['categorias'] = Categoria::where('categoria', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(10);
        }
        $this->data['search'] = $query;
        return view('backend.categorias.index',$this->data);
    }

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

    public function destroy($id)
    {
        Producto::whereIdCategoria($id)->update(['id_categoria' => 0]);
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect('/admin/categorias');
    }
}
