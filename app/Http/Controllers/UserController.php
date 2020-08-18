<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\FooterInfo;
use App\HeaderFrontend;
use App\Loader;
use App\Orden;
use App\SiteSocial;
use App\TeamMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Session;
use Image;

class UserController extends Controller
{
    public function __construct(){
        if(Session::has('auth_change_pass_user')){
            Session::remove('auth_change_pass_user');
        }
    }

    public function index($domain){
        if(!Auth::check()){
            if(!session()->has('from')){
                session()->put('from', url()->current());
            }
            return redirect('/login');
        }

        if($domain) {
            $loader = new Loader($domain);
            if($loader->checkDominio()){
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                $data['compras'] = Orden::where('id_user', Auth::user()->id)->get();
                return view('frontend.user', $data);
            }
        }
        return view('frontend.templates.site-not-found');

    }

    public function switchCliente(Request $request, $domain){
        if($request->ajax()){
            if($domain){
                $loader = new Loader($domain);
                if($loader->checkDominio()){
                    $loader->checkDominioAdmin();
                    $data = $loader->getData();
                    if($data['tienda']->clientes->contains(Auth::user()->id)){
                        $rel = $data['tienda']->clientes()->where('user_id', Auth::user()->id)->first();
                        if($rel->pivot->cliente){
                            $data['tienda']->clientes()->updateExistingPivot(Auth::user()->id, ['cliente' => false]);
                            return 'off';
                        }else{
                            $data['tienda']->clientes()->updateExistingPivot(Auth::user()->id, ['cliente' => true]);
                            return 'on';
                        }
                    }else{
                        $data['tienda']->clientes()->attach(Auth::user()->id);
                        return 'new';
                    }
                }
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        if($request->img){
            if($request->get('email') == $user->email){
                $request->validate([
                    'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=300,min_height=300',
                    'name' => 'required|max:50',
                    'lastname' => 'required|max:50',
                    'telefono' => 'required|max:50',
                ]);
            }else{
                $request->validate([
                    'img' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=300,min_height=300',
                    'name' => 'required|max:50',
                    'lastname' => 'required|max:50',
                    'telefono' => 'required|max:50',
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

            $img_delete = 'images/uploads/users/'. $user->img;
            if(File::exists(public_path($img_delete))) {
                if($user->img != 'avatar.png'){
                    File::delete($img_delete);
                }
            }
            $user->img = $imageName;
        }else{
            if($request->get('email') == $user->email){
                $request->validate([
                    'name' => 'required|max:50',
                    'lastname' => 'required|max:50',
                    'telefono' => 'required|max:50',
                ]);
            }else{
                $request->validate([
                    'name' => 'required|max:50',
                    'lastname' => 'required|max:50',
                    'telefono' => 'required|max:50',
                    'email' => 'required|max:255|email|unique:users'
                ]);
            }

        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->lastname = $request->get('lastname');
        $user->telefono = $request->get('telefono');

        $user->update();

        return redirect('/cuenta');
    }

    public function addDireccion(Request $request){
        $request->validate([
            'calle' => 'required',
            'numero' => 'required',
            'poblacion' => 'required',
            'ciudad' => 'required'
        ]);
        $user = Auth::user();
        $direccion = new Direccion();
        $direccion->calle = $request->get('calle');
        $direccion->numero = $request->get('numero');
        $direccion->departamento = $request->get('departamento');
        $direccion->poblacion = $request->get('poblacion');
        $direccion->ciudad = $request->get('ciudad');

        //TODO:Relacion no corresponde con Many to Many
        // $user->direcciones()->save($direccion);

        return redirect('/cuenta');
    }

    public function changePassword(Request $request){
        if(Session::has('auth_change_pass_user') && Session::get('auth_change_pass_user')){
            return view('frontend.templates.change-password', $this->data);
        }else{
            return redirect('/cuenta')->withErrors('Error al cambiar la contraseña');
        }

    }

    public function checkPassword(Request $request){
        if(Hash::check($request->get('oldpass'), Auth::user()->password)){
            $request->session()->put('auth_change_pass_user', true);
        }
        return redirect(route('user.view.changepass'));
    }

    public function resetCheckPassword(Request $request){
        if(Session::has('auth_change_pass_user')){
            $request->session()->remove('auth_change_pass_user');
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
        return redirect('/cuenta');
    }

    public function clientes(Request $request, $domain){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominioAdmin()){
                $data = $loader->getData();
                $search = trim($request->get('search'));
                if($request){
                    $clientes = User::where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('lastname', 'LIKE', '%'.$search.'%')->paginate(10);
                }
                $data['search'] = $search;
                $data['clientes'] = $clientes;
                return view('backend.users.index', $data);
            }
        }

        return view('frontend.templates.site-not-found');
    }
}
