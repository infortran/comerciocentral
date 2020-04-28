<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Slide;
use App\Social;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\TeamMember;
use App\FooterInfo;
use App\User;
use Image;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function index(){
        $data = [
            'header' => HeaderFrontend::findOrFail(1),
            'footer' => FooterInfo::findOrFail(1),
            'members' => TeamMember::all(),
            'slides' => Slide::all(),
            'socials' => Social::all()
        ];


    	return view('backend.home', $data);
    }

    /*public function store(){

    }*/

    public function show(){

    }

    public function update(Request $request, $id){
    	$admin = User::findOrFail($id);
    	if($request->img){
    		if($request->get('email') == $admin->email){
    			$request->validate([
	                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=300,max_height=300',
	                'name' => 'required|max:255'
            	]);
    		}else{
    			$request->validate([
	                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=300,max_height=300',
	                'name' => 'required|max:255',
	                'email' => 'required|max:255|email|unique:users'
            	]);
    		}

            $img = $request->file('img');

            $imageName = time().'.'.$img->extension();

            $imgResize = Image::make($img->path());
            $imgResize->fit(300,300, function($constraint) {
                $constraint->upsize();
            })->save(public_path('images/uploads/admin').'/'. $imageName);

            $img_delete = 'images/uploads/admin/'. $admin->img;
            if(File::exists(public_path($img_delete))) {
                File::delete($img_delete);
            }
            $admin->img = $imageName;
        }else{
        	if($request->get('email') == $admin->email){
        		$request->validate([
                	'name' => 'required|max:255',
            	]);
        	}else{
        		$request->validate([
	                'name' => 'required|max:255',
	                'email' => 'required|max:255|email|unique:users'
	            ]);
        	}

        }

    	$admin->name = $request->get('name');
    	$admin->email = $request->get('email');

    	$admin->update();

    	return redirect('/admin');
    }

    public function destroy(){

    }
}
