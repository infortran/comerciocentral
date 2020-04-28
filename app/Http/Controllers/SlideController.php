<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class SlideController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'producto_id' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'img_pricing' => 'required|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'required|mimes:jpeg,png,jpg|max:2048',
            'titulo' => 'required|max:255',
            'subtitulo' => 'required|max:255',
            'txt_boton' => 'required'
        ]);
        //200x60
        $img = $request->file('img');
        $img_pricing = $request->file('img_pricing');
        $logo = $request->file('logo');

        $imageName = $this->storeImgSlide($img, 485, 440);
        $imgPricingName = $this->storeImgSlide($img_pricing, 172, 172);
        $logoName = $this->storeImgSlide($logo, 200, 70);

        $slide = new Slide();
        $producto = Producto::find(request('producto_id'));

        $slide->titulo = request('titulo');
        $slide->subtitulo = request('subtitulo');
        $slide->txt_boton = request('txt_boton');
        $slide->img = $imageName;
        $slide->img_pricing = $imgPricingName;
        $slide->logo = $logoName;
        $producto->slides()->save($slide);
        $slide->save();

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);
        $img = $request->file('img');
        $img_pricing = $request->file('img_pricing');
        $logo = $request->file('logo');

        if($request->img && $request->img_pricing && $request->logo){
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'img_pricing' => 'required|mimes:jpeg,png,jpg|max:2048',
                'logo' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]);
            $imageName = $this->storeImgSlide($img, 485, 440);
            $imgPricingName = $this->storeImgSlide($img_pricing, 172, 172);
            $logoName = $this->storeImgSlide($logo, 200, 60);
            $this->destroyImgSlide($slide->img);
            $this->destroyImgSlide($slide->img_pricing);
            $this->destroyImgSlide($slide->logo);
            $slide->img = $imageName;
            $slide->img_pricing = $imgPricingName;
            $slide->logo = $logoName;
        }else if($request->img && $request->img_pricing){
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'img_pricing' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]);
            $imageName = $this->storeImgSlide($img, 485, 440);
            $imgPricingName = $this->storeImgSlide($img_pricing, 172, 172);
            $this->destroyImgSlide($slide->img);
            $this->destroyImgSlide($slide->img_pricing);
            $slide->img = $imageName;
            $slide->img_pricing = $imgPricingName;
        }else if($request->img_pricing && $request->logo){
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
                'logo' => 'required|mimes:jpeg,png,jpg|max:2048',
                'img_pricing' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]);
            $imgPricingName = $this->storeImgSlide($img_pricing, 172, 172);
            $logoName = $this->storeImgSlide($logo, 200, 60);
            $this->destroyImgSlide($slide->img_pricing);
            $this->destroyImgSlide($slide->logo);
            $slide->img_pricing = $imgPricingName;
            $slide->logo = $logoName;
        }else if($request->img && $request->logo){
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'logo' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]);
            $imageName = $this->storeImgSlide($img, 485, 440);
            $logoName = $this->storeImgSlide($logo, 200, 60);
            $this->destroyImgSlide($slide->img);
            $this->destroyImgSlide($slide->logo);
            $slide->img = $imageName;
            $slide->logo = $logoName;
        }else if($request->img){
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $imageName = $this->storeImgSlide($img, 485, 440);
            $this->destroyImgSlide($slide->img);
            $slide->img = $imageName;
        }else if($request->img_pricing){
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
                'img_pricing' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]);
            $imgPricingName = $this->storeImgSlide($img_pricing, 172, 172);
            $this->destroyImgSlide($slide->img_pricing);
            $slide->img_pricing = $imgPricingName;
        }else if($request->logo){
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
                'logo' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]);
            $logoName = $this->storeImgSlide($logo, 190, 60);
            $this->destroyImgSlide($slide->logo);
            $slide->logo = $logoName;
        }else{
            $request->validate([
                'producto_id' => 'required',
                'titulo' => 'required|max:255',
                'subtitulo' => 'required|max:255',
                'txt_boton' => 'required',
            ]);
        }
        $producto = Producto::find($request->get('producto_id'));
        $slide->titulo = $request->get('titulo');
        $slide->subtitulo = $request->get('subtitulo');
        $slide->txt_boton = $request->get('txt_boton');
        $producto->slides()->save($slide);
        $slide->update();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        $this->destroyImgSlide($slide->img);
        $this->destroyImgSlide($slide->img_pricing);
        $this->destroyImgSlide($slide->logo);
        $slide->delete();

        return redirect('/admin');
    }

    public function destroyImgSlide($path){
        $img_delete = 'images/uploads/slides/'. $path;
        if(File::exists(public_path($img_delete))){
            File::delete($img_delete);
        }
    }

    public function storeImgSlide($img, $width, $height){
        $imageName = $img->getClientOriginalName(). time().'.'.$img->extension();
        $imgResize = Image::make($img->path());
        $imgResize->fit($width, $height, function($constraint) {
            $constraint->upsize();
        })->save(public_path('images/uploads/slides').'/'. $imageName);
        return $imageName;
    }
}
