<?php

namespace App\Http\Controllers;

use App\Loader;
use App\SiteSocial;
use App\Social;
use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\FooterInfo;
use App\TeamMember;

class ContactoController extends Controller
{
    public function index(){
        $domain = request()->route('domain');
        if($domain) {
            $loader = new Loader($domain);
            //dd($loader->checkDominio());
            if ($loader->checkDominio()) {
                $data = $loader->getData();
                return view('frontend.contacto', $data);
            }
        }
        return view('frontend.templates.site-not-found');


    }
}
