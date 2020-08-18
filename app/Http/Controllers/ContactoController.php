<?php

namespace App\Http\Controllers;

use App\Loader;
use App\Mensaje;
use App\SiteSocial;
use Auth;
use App\Social;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\FooterInfo;
use App\TeamMember;

class ContactoController extends Controller
{
    public function index($domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                return view('frontend.contacto', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }

    public function enviarMensaje(Request $request, $domain){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominio()){
                $data = $loader->getData();
                $validation = [
                    'motivo' => 'required',
                    'asunto' => 'required|max:50',
                    'mensaje' => 'required|max:500',
                    'orden' => 'numeric|nullable'
                ];
                if(!Auth::check()){
                    $validation['name'] = 'required|max:55';
                    $validation['lastname'] = 'required|max:55';
                    $validation['email'] = 'required|email|max:55';
                    $validation['telefono'] = 'required|max:50';
                }
                $request->validate($validation);
                $mensaje = new Mensaje();
                $mensaje->orden_id = $request->get('orden');
                $mensaje->user_id = Auth::check() ? Auth::user()->id : null;
                $mensaje->name = Auth::check() ? Auth::user()->name : $request->get('name');
                $mensaje->lastname = Auth::check() ? Auth::user()->lastname : $request->get('lastname');
                $mensaje->email = Auth::check() ? Auth::user()->email : $request->get('email');
                $mensaje->telefono = Auth::check() ? Auth::user()->telefono : $request->get('telefono');
                $mensaje->asunto = $request->get('asunto');
                $mensaje->mensaje = $request->get('mensaje');
                $mensaje->motivo = $request->get('motivo');
                $data['tienda']->mensajes()->save($mensaje);

                return redirect('/contacto');
            }
        }

    }
}
