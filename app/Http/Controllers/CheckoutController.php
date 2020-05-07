<?php

namespace App\Http\Controllers;

use App\Loader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Session;

class CheckoutController extends Controller
{
    private $data;

    public function __construct(){
        $data = new Loader();
        $this->data = $data->getData();
    }

    public function index(Request $request){
        $cart = null;
        $envio = 0;
        $total = 0;
        if(Session::has('cart')){
            $cart = Session::get('cart');
            $total = $cart->precioTotal;
            if(Session::has('precio_envio')){
                $envio = Session::get('precio_envio');
                $total = $cart->precioTotal + $envio;
            }
        }
        $this->data['cart'] = $cart;
        $this->data['precio_envio'] = $envio;
        $this->data['total_final'] = $total;
        return view('frontend.checkout', $this->data);
    }

    public function getPaymentProcess(Request $request){

    }

    public function getWebpay($amount, $sessionId, $buyOrder){
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $returnUrl = url('/payment_process');
        $finalUrl = url('/final');
        $initResult = $transaction->initTransaction(
            $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
        //dd($initResult->url);
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;
        if($formAction && $tokenWs){
            $this->formAction = $formAction;
            $this->tokenWs = $tokenWs;
            return true;
        }else{
            return false;
        }
    }
    public function paymentProcess(Request $request){
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $tokenWs = $request->get('token_ws');

        $result = $transaction->getTransactionResult($tokenWs);
        $output = $result->detailOutput;

        if($output->responseCode == 0){
            $session_data = [
                'auth_code' => $output->authorizationCode,
                'amount' => $output->amount,
                'response_code' => $output->responseCode
            ];
            Session::put('payment_data', $session_data);
            //dd($result->urlRedirection);
            $data = [
                'url_redirection' => $result->urlRedirection,
                'token_ws' => $tokenWs
            ];
            return view('frontend.templates.webpay_process', $data);
        }
        return redirect('/');
    }


}
