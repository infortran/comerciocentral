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

        if(Session::has('cart')){
            $envio = null;

            $cart = Session::get('cart');
            $total = $cart->precioTotal;
            if(Session::has('precio_envio')){
                $envio = Session::get('precio_envio');
                $total = $cart->precioTotal + $envio;
            }

            $this->data['cart'] = $cart;
            $this->data['precio_envio'] = $envio;
            $this->data['total_final'] = $total;
            return view('frontend.checkout', $this->data);
        }else{
            return redirect('/carrito');
        }
    }

    public function getPaymentProcess(Request $request){
        if(Session::has('cart')){
            $cart = Session::get('cart');
            $total = $cart->precioTotal;
            if(Session::has('precio_envio')){
                $envio = Session::get('precio_envio');
                $total = $cart->precioTotal + $envio;
            }
            $this->data['amount'] = $total;
            return view('frontend.templates.payment_process', $this->data);
        }else{
            return redirect('/carrito');
        }

    }

    public function getWebpay($amount, $buyOrder){
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $returnUrl = url('/payment_process');
        $finalUrl = url('/final');
        $sessionId = Session::getId();
        $initResult = $transaction->initTransaction(
            $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
        //dd($initResult->url);
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;
        if($formAction && $tokenWs){
            $this->data['form_action'] = $formAction;
            $this->data['token_ws'] = $tokenWs;
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
            $payment_data = [
                'auth_code' => $output->authorizationCode,
                'amount' => $output->amount,
                'response_code' => $output->responseCode
            ];
            Session::put('payment_data', $payment_data);
            //dd($result->urlRedirection);
            $data = [
                'url_redirection' => $result->urlRedirection,
                'token_ws' => $tokenWs
            ];
            return view('frontend.templates.webpay_process', $data);
        }
        return redirect('/');
    }

    public function finalProcess(){
        $payment_data = Session::has('payment_data') ? Session::get('payment_data') : null;
        $this->data['payment_data'] = $payment_data;
        return view('frontend.final', $this->data);
    }
}
