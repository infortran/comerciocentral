<?php

namespace App\Http\Controllers;

use App\Envio;
use App\Http\Controllers\Controller;
use App\Jobs\deleteCheckPassword;
use App\SiteSocial;
use App\Slide;
use App\Social;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\TeamMember;
use App\FooterInfo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\File;
use Session;


class AdminController extends Controller
{
    private $users;

    public function __construct(){
    	$this->middleware('admin');
    }

    public function index(Request $request){
        $data = [
            'header' => HeaderFrontend::findOrFail(1),
            'footer' => FooterInfo::findOrFail(1),
            'members' => TeamMember::all(),
            'slides' => Slide::all(),
            'socials' => Social::all(),
            'site_socials' => SiteSocial::all(),
            'envios' => Envio::all()
        ];

        if(Session::has('auth_change_pass')){
            Session::remove('auth_change_pass');
        }
    	return view('backend.home', $data);
    }

    /*public function store(){

    }*/

    public function show(Request $request){
        $query = trim($request->get('search'));
        if($request){
            $this->users = User::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('lastname', 'LIKE', '%' . $query . '%')->orderBy('id', 'asc')->paginate(10);
        }
        $data = [
            'header' => HeaderFrontend::findOrFail(1),
            'footer' => FooterInfo::findOrFail(1),
            'socials' => Social::all(),
            'siteSocials' => SiteSocial::all(),
            'search' => $query,
            'users' => $this->users
        ];
        return view('backend.users.index', $data);
    }

    public function banUser($id){
        $user = User::find($id);
        $user->is_banned = true;
        $user->save();
        return redirect()->back();
    }

    public function unlockUser($id){
        $user = User::find($id);
        $user->is_banned = false;
        $user->save();
        return redirect()->back();
    }

    //UPDATE DATA ADMIN
    public function update(Request $request, $id){
    	$admin = User::findOrFail($id);
    	if($request->img){
    		if($request->get('email') == $admin->email){
    			$request->validate([
	                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=300,min_height=300',
	                'name' => 'required|max:50'
            	]);
    		}else{
    			$request->validate([
	                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=300,min_height=300',
	                'name' => 'required|max:255',
	                'email' => 'required|max:255|email|unique:users'
            	]);
    		}
            //get image file
            $img = $request->file('img');
            //get only filename
            $img_filename = pathinfo($img->getClientOriginalName())['filename'];
            //rename with date
            $imageName = $img_filename.time().'.'.$img->extension();

            $imgResize = Image::make($img->path());
            $imgResize->fit(300,300, function($constraint) {
                $constraint->upsize();
            })->save(public_path('images/uploads/users').'/'. $imageName);

            $img_delete = 'images/uploads/users/'. $admin->img;
            if(File::exists(public_path($img_delete))) {
                if($admin->img != 'avatar.png'){
                    File::delete($img_delete);
                }
            }
            $admin->img = $imageName;
        }else{
        	if($request->get('email') == $admin->email){
        		$request->validate([
                	'name' => 'required|max:50'
            	]);
        	}else{
        		$request->validate([
	                'name' => 'required|max:50',
	                'email' => 'required|max:255|email|unique:users'
	            ]);
        	}

        }

    	$admin->name = $request->get('name');
    	$admin->email = $request->get('email');

    	$admin->update();

    	return redirect('/admin');
    }

    public function changePassword(Request $request){
        if(Session::has('auth_change_pass') && Session::get('auth_change_pass')){
            $data = [
                'header' => HeaderFrontend::findOrFail(1),
                'footer' => FooterInfo::findOrFail(1),
                'members' => TeamMember::all(),
                'slides' => Slide::all(),
                'socials' => Social::all(),
                'site_socials' => SiteSocial::all()
            ];
            return view('backend.templates.change-password', $data);
        }else{
            return redirect('/admin')->withErrors('Error al cambiar la contraseña');
        }

    }

    public function checkPassword(Request $request){
        if(Hash::check($request->get('oldpass'), Auth::user()->password)){
            $request->session()->put('auth_change_pass', true);

        }
        return redirect(route('admin.view.changepass'));
    }

    public function resetCheckPassword(Request $request){
        if(Session::has('auth_change_pass')){
            $request->session()->remove('auth_change_pass');
        }
    }

    public function updatePassword(Request $request){
        $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required|min:8',
            'repeatpass' => 'required|same:newpass'
        ]);


        $user = Auth::user();
        $user->password = Hash::make($request->get('newpass'));
        $user->save();
        return redirect('/admin');
    }

    public function destroy(){

    }
}
