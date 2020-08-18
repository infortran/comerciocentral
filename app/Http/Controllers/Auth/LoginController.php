<?php

namespace App\Http\Controllers\Auth;

use App\FooterInfo;
use App\HeaderFrontend;
use App\Http\Controllers\Controller;
use App\Loader;
use App\Providers\RouteServiceProvider;
use App\SiteSocial;
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
    protected $redirectTo = '/';


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



    public function showLoginForm(Request $request, $domain)
    {
        if(!session()->has('from')){
            session()->put('from', url()->previous());
        }
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $data = $loader->getData();
                return view('frontend.login', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }
}
