<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Loader;
use App\Tienda;
use Illuminate\Http\Request;
use App\Producto;
//use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(Request $request, $domain)
    {
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominioAdmin()) {
                $data = $loader->getData();
                $query = trim($request->get('search'));
                if($request){
                    $data['categorias'] = Categoria::where('tienda_id', $data['tienda']->id)->where('categoria', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(10);
                }
                $data['search'] = $query;
                return view('backend.categorias.index',$data);
            }
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|max:50|regex:[A-Za-z1-9 ]'
        ]);
        $tienda = Tienda::findOrFail($request->get('tienda'));
        $categoria = new Categoria();
        $categoria->categoria = request('categoria');
        $tienda->categorias()->save($categoria);
        return redirect('/admin/categorias');
    }

    public function update(Request $request,$domain, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $request->validate([
            'categoria' => 'required|max:50|regex:[A-Za-z1-9 ]'
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
