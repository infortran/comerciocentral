<?php

namespace App\Http\Controllers;

use App\Social;
use App\User;
use Illuminate\Http\Request;

class SocialController extends Controller
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
        $request->validate([
            'nombre' => 'required',
            'url' => 'required'
        ]);
        $social = new Social();

        $social->nombre = request('nombre');
        $social->url = request('url');

        $social->save();

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        $social->users()->detach();
        $social->delete();
        return redirect('/admin');
    }

    public function addSocialToUser(Request $request, $id){
        $request->validate([
            'uri' => 'required'
        ]);
        $uri = request('uri');
        $user = User::find($id);
        $social = request('social_id');
        $user->socials()->attach([$social => ['uri' => '/'.$uri]]);

        return redirect('/admin');
    }

    public function detachSocialToUser(Request $request, $user_id, $social){
        $user = User::findOrFail($user_id);
        $user->socials()->detach($social);
        return redirect('/admin');
    }
}
