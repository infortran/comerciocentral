<?php

namespace App\Http\Controllers;

use App\Tienda;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class MainController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        //Session::flush();
        //Session::save();
    }

    public function checkDomain($dir){
        if(checkdnsrr($dir, 'ANY')){
            echo 'Ya existe';
        }else{
            echo 'Disponible';
        }
    }

    public function index(Request $request){
        if(Auth::check()){
            $domain = Auth::user()->tiendas()->first()->dominio ?? null;
            if($domain){
                $url = env('APP_PROTOCOL').'://'.$domain.'.comerciocentral.'.env('APP_DOMAIN');
                return redirect($url);
            }
            return redirect('/tienda');
        }
        return view('main.index');

    }

    public function tienda(Request $request){
        if(Auth::check()){
            return view('main.tienda');
        }
        return redirect('/registro');
    }

    public function login(Request $request){
        return view('main.login');
        //$data['color'] = '#afafaf';
        //return view('welcome', $data);
    }



    public function register(Request $request){
        $domain = $request->get('domain');
        $domain_trim = trim($domain);
        //eliminar espacios
        $domain_s_esp = str_replace(' ','', $domain_trim);
        $tienda = Tienda::where('dominio', $domain_s_esp)->get();
        if(count($tienda) > 0){
            return redirect('/')->withErrors('Lo sentimos la tienda que has escogido ya existe.');
        }
        $data['domain'] = $domain_s_esp;
        $data['nombre_tienda'] = $domain;
        return view('main.register', $data);
    }

    public function checkTienda(Request $request, $domain){
        if($request->ajax()){
            $tienda = Tienda::where('dominio', $domain)->get();
            if(count($tienda) > 0){
                return json_encode(['domain_status' => false]);
            }
            return json_encode(['domain_status' => true]);
        }
        return redirect('/');
    }

    public function checkTiendaEmail(Request $request, $email){
        if($request->ajax()){
            $tienda = Tienda::where('email', $email)->get();
            $user = User::where('email', $email)->get();
            if(count($tienda) > 0 || count($user) > 0){
                return json_encode(['email_tienda_status' => false]);
            }
            return json_encode(['email_tienda_status' => true]);
        }
        return redirect('/');
    }

    public function checkTiendaDomainEmail(Request $request,$domain, $email){
        if($request->ajax()){
            $domain = Tienda::where('dominio', $domain)->get();
            $email = Tienda::where('email', $email)->get();
            $email_u = User::where('email', $email)->get();
            if(count($email) > 0 || count($domain) > 0 || count($email_u) > 0){
                return json_encode(['domain_email_tienda_status' => false ]);
            }
            return json_encode(['domain_email_tienda_status' => true ]);
        }
        return redirect('/');
    }

    public function checkEmail(Request $request, $email){
        if($request->ajax()){
            $email = User::where('email', $email)->get();
            if(count($email) > 0){
                return json_encode(['email_status' => false ]);
            }
            return json_encode(['email_status' => true ]);
        }
        return redirect('/');
    }

    public function submitRegister(Request $request){
        //dd($request->get('telefono_tienda'));
        $request->validate([
            'username' => 'required|min:3|max:255',
            'userlastname' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'nombre_tienda' => 'required|min:2|max:50',
            'email_tienda' => 'required|email|min:3|max:50',
            'telefono_tienda' => 'required|min:8|max:10',
            'info_tienda' => 'required|min:20|max:200'
        ]);

        $nombre = $request->get('nombre_tienda');
        $nombre_trim = trim($nombre);
        $nombre_lower = strtolower($nombre_trim);
        $domain = str_replace(' ', '', $nombre_lower);

        //GUARDAR DATOS DEL USUARIO
        $user = new User();
        $user->name = $request->get('username');
        $user->lastname = $request->get('userlastname');
        $user->email = $request->get('email');
        $user->telefono = $request->get('telefono_tienda');
        $user->password = Hash::make($request->get('password'));
        $tienda = new Tienda();
        $tienda->nombre = $nombre;
        $tienda->dominio = $domain;
        $tienda->info = $request->get('info_tienda');
        $tienda->telefono = $request->get('telefono_tienda');
        $tienda->email = $request->get('email_tienda');

        $user->save();
        $user->tiendas()->save($tienda);
        return redirect(env('APP_PROTOCOL').'://'.$domain.'.comerciocentral.'.env('APP_DOMAIN'));
    }


    public function create(){

    }

    public function store(){

    }
}
