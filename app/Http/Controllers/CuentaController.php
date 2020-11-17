<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tienda;

class CuentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('frontend.user.index', ['tienda' => Tienda::find(request()->redirectID)]);
    }

    public function compras(){
        return view('frontend.user.compras',['tienda' => Tienda::find(request()->redirectID)]);
    }
}
