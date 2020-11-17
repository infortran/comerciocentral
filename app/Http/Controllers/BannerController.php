<?php
//CONTROLADOR BANNER ADMIN
namespace App\Http\Controllers;

use App\AsideBanner;
use App\Loader;
use App\ProductoBanner;
use App\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($domain){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominioAdmin()){
                $data = $loader->getData();
                return view ('backend.banners.index', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function updateAside(Request $request, $domain){
        $request->validate([
            'dscto' => 'required||regex:[A-Za-z1-9 ]',
            'btn' => 'required|max:20|regex:[A-Za-z1-9 ]'
        ]);
        $tienda = Tienda::findOrFail($request->get('tienda'));
        $asidebanner = $tienda->asidebanner ? $tienda->asidebanner : new AsideBanner();
        $asidebanner->dscto = $request->get('dscto');
        $asidebanner->btn = $request->get('btn');
        $asidebanner->producto_id = $request->get('producto');
        $asidebanner->color_princ_a = $request->get('color-princ-a');
        $asidebanner->color_princ_b = $request->get('color-princ-b');
        $asidebanner->color_sec_a = $request->get('color-sec-a');
        $asidebanner->color_sec_b = $request->get('color-sec-b');
        if($tienda->asidebanner){
            $asidebanner->save();
        }else{
            $tienda->asidebanner()->save($asidebanner);
        }


        return redirect('admin/banners');
    }

    public function updateProducto(Request $request, $domain){
        $tienda = Tienda::findOrFail($request->get('tienda'));
        $banner = $tienda->productobanner ? $tienda->productobanner : new ProductoBanner();
        if($request->img){
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'titulo' => 'required|max:50|regex:[A-Za-z1-9 ]',
                'txt1' => 'required|regex:[A-Za-z1-9 ]',
                'txt2' => 'required|regex:[A-Za-z1-9 ]',
                'btn' => 'required|regex:[A-Za-z1-9 ]',
                'dscto' => 'required|regex:[A-Za-z1-9 ]'
            ]);

            $img = $request->file('img');
            $imageName = time().'.'.$img->extension();
            $imgResize = Image::make($img->path());
            $imgResize->fit(200,200, function($constraint) {
                $constraint->upsize();
            })->save(public_path('images/uploads/marcas').'/'. $imageName);

            $img_delete = 'images/uploads/marcas/'. $banner->img;
            if(File::exists(public_path($img_delete))) {
                if(!$banner->img == 'logo.jpg'){
                    File::delete($img_delete);
                }
            }
            $banner->img = $imageName;
        }else {
            $request->validate([
                'titulo' => 'required|max:50|regex:[A-Za-z1-9 ]',
                'txt1' => 'required|regex:[A-Za-z1-9 ]',
                'txt2' => 'required|regex:[A-Za-z1-9 ]',
                'btn' => 'required|regex:[A-Za-z1-9 ]',
                'dscto' => 'required|regex:[A-Za-z1-9 ]'
            ]);
        }

        $banner->titulo = $request->get('titulo');
        $banner->txt1 = $request->get('txt1');
        $banner->txt2 = $request->get('txt2');
        $banner->btn = $request->get('btn');
        $banner->dscto = $request->get('dscto');
        $banner->color_bg_a1 = $request->get('color-bg-a1');
        $banner->color_bg_a2 = $request->get('color-bg-a2');
        $banner->color_bg_b1 = $request->get('color-bg-b1');
        $banner->color_bg_b2 = $request->get('color-bg-b2');
        $banner->producto_id = $request->get('producto');
        $banner->color_titulo = $request->get('color-titulo');
        $banner->color_texto = $request->get('color-texto');

        $tienda->productobanner()->save($banner);

        return redirect('/admin/banners');
    }
}
