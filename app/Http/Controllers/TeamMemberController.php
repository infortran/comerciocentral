<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\TeamMember;
use Image;
use Illuminate\Support\Facades\File;

class TeamMemberController extends Controller
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
            'img_member' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nombre' => 'required|max:255',
            'cargo' => 'required|max:255'
        ]);

        $img_member = $request->file('img_member');
  
        $imageName = time().'.'.$img_member->extension();  

        $img = Image::make($img_member->path());
        $img->fit(200,100, function($constraint) {
            $constraint->upsize();
        })->save(public_path('images/uploads/members').'/'. $imageName);

        $member = new TeamMember();

        $member->nombre = request('nombre');
        $member->cargo = request('cargo');
        $member->img_member = $imageName;

        $member->save();

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\teamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(teamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\teamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(teamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\teamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $teamMember = TeamMember::findOrFail($id);
        if($request->img_member){
            $request->validate([
                'img_member' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=300,max_height=200',
                'nombre' => 'required|max:255',
                'cargo' => 'required|max:255'
            ]);
            $img_member = $request->file('img_member');
  
            $imageName = time().'.'.$img_member->extension();  

            $img = Image::make($img_member->path());
            $img->fit(200,100, function($constraint) {
                $constraint->upsize();
            })->save(public_path('images/uploads/members').'/'. $imageName);

            $img_delete = 'images/uploads/members/'. $teamMember->img_member;
            if(File::exists(public_path($img_delete))) {
                File::delete($img_delete);
            }
            $teamMember->img_member = $imageName;
        }else{
            $request->validate([
                'nombre' => 'required|max:255',
                'cargo' => 'required|max:255'
            ]);
        }

        $teamMember->nombre = $request->get('nombre');
        $teamMember->cargo = $request->get('cargo');        

        $teamMember->update();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\teamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teamMember = TeamMember::findOrFail($id);
        $img_delete = 'images/uploads/members/'. $teamMember->img_member;
        if(File::exists(public_path($img_delete))) {
            File::delete($img_delete);
        }
        $teamMember->delete();

        return redirect('/admin');
    }
}
