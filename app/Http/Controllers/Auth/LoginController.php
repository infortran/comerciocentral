<?php

namespace App\Http\Controllers\Auth;

use App\FooterInfo;
use App\HeaderFrontend;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\TeamMember;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin';


    public function authenticated($request,$user)
    {
        return redirect(session()->pull('from',$this->redirectTo));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function showLoginForm()
    {
        if(!session()->has('from')){
            session()->put('from', url()->previous());
        }
        $data = [
          'header' => HeaderFrontend::find(1),
          'footer' => FooterInfo::find(1),
          'members' => TeamMember::all()
        ];
        return view('frontend.login', $data);
    }
}
