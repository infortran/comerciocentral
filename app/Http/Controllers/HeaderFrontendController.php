<?php

namespace App\Http\Controllers;

use App\HeaderFrontend;
use Illuminate\Http\Request;


class HeaderFrontendController extends Controller
{
    public function __construct(){
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HeaderFrontend  $headerFrontend
     * @return \Illuminate\Http\Response
     */
    public function show(HeaderFrontend $headerFrontend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HeaderFrontend  $headerFrontend
     * @return \Illuminate\Http\Response
     */
    public function edit(HeaderFrontend $headerFrontend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HeaderFrontend  $headerFrontend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $header = HeaderFrontend::findOrFail($id);
        
        if($request->img_header){
            $request->validate([
                'img_header' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'telefono' => 'required|max:12',
                'email' => 'required|email|max:25',
                'facebook' => 'required|max:50',
                'twitter' => 'required|max:50',
                'instagram' => 'required|max:50',
                'linkedin' => 'required|max:50'
            ]);
            $imageName = time().'.'.$request->img_header->extension();  
   
            $request->img_header->move(public_path('images/system'), $imageName);

            $img_delete = 'images/system/'. $producto->img_header;
            if(File::exists(public_path($img_delete))) {
                File::delete($img_delete);
            }
            $producto->img_header = $imageName;
        }else{
            $request->validate([
                'telefono' => 'required|max:20',
                'email' => 'required|email|max:25',
                'facebook' => 'required|max:50',
                'twitter' => 'required|max:50',
                'instagram' => 'required|max:50',
                'linkedin' => 'required|max:50'
            ]);
        }

        $header->telefono = $request->get('telefono');
        $header->email = $request->get('email');
        $header->facebook = $request->get('facebook');
        $header->twitter = $request->get('twitter');
        $header->instagram = $request->get('instagram');
        $header->linkedin = $request->get('linkedin');
        

        $header->update();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HeaderFrontend  $headerFrontend
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeaderFrontend $headerFrontend)
    {
        //
    }
}
