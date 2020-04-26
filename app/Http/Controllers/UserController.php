<?php

namespace App\Http\Controllers;

use App\FooterInfo;
use App\HeaderFrontend;
use App\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
