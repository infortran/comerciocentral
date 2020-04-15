<?php

namespace App\Http\Controllers;

use App\FooterInfo;
use Illuminate\Http\Request;

class FooterInfoController extends Controller
{
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
     * @param  \App\FooterInfo  $footerInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FooterInfo $footerInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FooterInfo  $footerInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterInfo $footerInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FooterInfo  $footerInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $footer = FooterInfo::findOrFail($id);
        
        $footer->info = $request->get('info');
        $footer->direccion = $request->get('direccion');

        $footer->update();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FooterInfo  $footerInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterInfo $footerInfo)
    {
        //
    }
}
