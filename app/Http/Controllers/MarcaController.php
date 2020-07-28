<?php

namespace App\Http\Controllers;

use App\Loader;
use App\Marca;
use App\Tienda;
use Illuminate\Http\Request;
use App\Producto;

class MarcaController extends Controller
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
                    $data['marcas'] = Marca::where('tienda_id', $data['tienda']->id)->where('marca', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(10);
                }
                $data['search'] = $query;
                return view('backend.marcas.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|max:50'
        ]);
        $tienda = Tienda::findOrFail($request->get('tienda'));
        $marca = new Marca();
        $marca->marca = request('marca');
        $tienda->marcas()->save($marca);

        return redirect('/admin/marcas');
    }


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

    public function destroy($id)
    {
        Producto::whereIdMarca($id)->update(['id_marca' => 0]);
        $marca = Marca::findOrFail($id);
        $marca->delete();
        return redirect('/admin/marcas');
    }
}
