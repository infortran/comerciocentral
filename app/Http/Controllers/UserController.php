<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\FooterInfo;
use App\HeaderFrontend;
use App\TeamMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(){
        if(!Auth::check()){
            if(!session()->has('from')){
                session()->put('from', url()->current());
            }
            return redirect('/login');
        }
        $data = [
            'header' => HeaderFrontend::find(1),
            'footer' => FooterInfo::find(1),
            'members' => TeamMember::all()
        ];
        return view('frontend.user', $data);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        if($request->img){
            if($request->get('email') == $user->email){
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
            })->save(public_path('images/uploads/users').'/'. $imageName);

            $img_delete = 'images/uploads/users/'. $user->img;
            if(File::exists(public_path($img_delete))) {
                File::delete($img_delete);
            }
            $user->img = $imageName;
        }else{
            if($request->get('email') == $user->email){
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

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        $user->update();

        return redirect('/cuenta');
    }

    public function addDireccion(Request $request){
        $user = Auth::user();
        $request->validate([
            'calle' => 'required',
            'numero' => 'required',
            'poblacion' => 'required',
            'ciudad' => 'required'
        ]);

        $direccion = new Direccion();
        $direccion->calle = $request->get('calle');
        $direccion->numero = $request->get('numero');
        $direccion->departamento = $request->get('departamento');
        $direccion->poblacion = $request->get('poblacion');
        $direccion->ciudad = $request->get('ciudad');

        $user->direccions()->save($direccion);

        return redirect('/cuenta');
    }
}
