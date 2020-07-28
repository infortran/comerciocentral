<?php

namespace App\Http\Controllers;

use App\Loader;
use Illuminate\Http\Request;

class CertController extends Controller
{
    public function index($domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                return view('frontend.cert', $data);
            }
        }
    }
}
