<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Loader;
use App\Orden;
use App\WebpayOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Session;

class CheckoutController extends Controller
{
    private $data, $orden;

    public function __construct(){
        $data = new Loader();
        $this->data = $data->getData();
    }

    public function index(Request $request){

        if(Session::has('cart')){

            $cart = Session::get('cart');
            $total = $cart->precioTotal;
            if(Session::has('envio')){
                $total = $cart->precioTotal + Session::get('envio')->precio;
            }

            $this->data['cart'] = $cart;
            $this->data['total_final'] = $total;
            return view('frontend.checkout', $this->data);
        }else{
            return redirect('/carrito');
        }
    }

    public function getPaymentProcess(Request $request){
        $dir_string = null;
        $nombre = null;
        $envio = null;
        if(!Session::has('cart')){
            return redirect('/carrito');
        }

        if(Session::has('envio')){
            $envio = Session::get('envio')->precio;
            if(Auth::check()){
                $direccion = Direccion::find($request->get('direccion_envio'));
                $dir_string = $direccion->calle.' / ';
                $dir_string .= $direccion->numero. ' / ';
                $dir_string .= $direccion->departamento ? $direccion->departamento.' / ' : '' ;
                $dir_string .= $direccion->poblacion. ' / ';
                $dir_string .= $direccion->ciudad. '.';
            }else{
                $request->validate([
                    'calle' => 'required',
                    'numero' => 'required',
                    'poblacion' => 'required',
                    'ciudad' => 'required']);
                $dir_string = $request->get('calle').' / ';
                $dir_string .= $request->get('numero'). ' / ';
                $dir_string .= $request->get('departamento') ? $request->get('departamento').' / ' : '' ;
                $dir_string .= $request->get('poblacion'). ' / ';
                $dir_string .= $request->get('ciudad'). '.';
            }
        }
        if(!Auth::check()){
            $request->validate([
                'nombre' => 'required',
                'email' => 'required|email',
                'telefono' => 'required',
            ]);
        }else{
            $nombre = Auth::user()->name.' '.Auth::user()->lastname;
        }

        $cart = Session::get('cart');
        $total = $envio ? $cart->precioTotal + $envio : $cart->precioTotal;
        $orden = new Orden();
        $orden->nombre = $nombre ? $nombre : $request->get('nombre');
        $orden->email = Auth::check() ? Auth::user()->email : $request->get('email');
        $orden->telefono = Auth::check() ? Auth::user()->telefono : $request->get('telefono');
        $orden->id_user = Auth::check() ? Auth::user()->id : null;
        $orden->cart = serialize($cart);
        $orden->envio = $envio;
        $orden->direccion = $dir_string ? $dir_string : null;
        $this->orden = $orden;

        if($request->get('forma_pago') == 'webpay'){
            $orden->save();
            if($this->getWebpay($total, $orden->id)){
                //SI WEBPAY AUTORIZA LA TRANSACCION SE CARGA LA VISTA DEL PAYMENT PROCESS
                return view('frontend.templates.payment_process', $this->data);
            }else{
                return redirect('checkout')->withErrors("Error en la autorizacion de WEBPAY");
            }
        }else{
            $orden->estado = 'deposito';
            $orden->save();
            dd('PAGO CON DEPOSITO');
        }
    }

    public function getDepositoPaymentProcess(Request $request){

    }

    public function getWebpay($amount, $buyOrder){
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $returnUrl = url('/payment/process');
        $finalUrl = url('/payment/final');
        $sessionId = Session::getId();
        $initResult = $transaction->initTransaction(
            $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
        //dd($initResult->url);
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;
        if($formAction != null && $tokenWs != null){
            $this->data['form_action'] = $formAction;
            $this->data['token_ws'] = $tokenWs;
            //dd($this->data['form_action']);
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

        if(is_array($result)){
            return redirect('/')->withErrors('Error al procesar el pago en WEBPAY');
        }
        $output = $result->detailOutput;
        if($output->responseCode == 0){
            //guardar los datos del pago en la db
            $webpayOrden = new WebpayOrden();
            $webpayOrden->session_id = $result->sessionId;
            $webpayOrden->card_number = $result->cardDetail->cardNumber;
            $webpayOrden->accounting_date = $result->accountingDate;
            $webpayOrden->transaction_date = $result->transactionDate;
            $webpayOrden->authorization_code = $output->authorizationCode;
            $webpayOrden->amount = $output->amount;
            $webpayOrden->shares_number = $output->sharesNumber;
            $webpayOrden->commerce_code = $output->commerceCode;
            $orden = Orden::find($output->buyOrder);
            //CAMBIAR EL ESTADO DE ORDEN A CONFIRMADO
            $orden->estado = 'pagado';
            $this->orden = $orden;
            $orden->save();
            $orden->webpayOrdens()->save($webpayOrden);
        }
        $data = [
            'card_number' => $result->cardDetail->cardNumber,
            'authorization_code' => $output->authorizationCode,
            'amount' => number_format($output->amount, 0, '', '.'),
            'buy_order' => $output->buyOrder,
            'shares_number' => $output->sharesNumber,
            'response_code' => $output->responseCode,
            'url_redirection' => $result->urlRedirection,
            'token_ws' => $tokenWs,
            'nombre' => $this->orden->nombre,
            'direccion' => $this->orden->direccion
        ];
        return view('frontend.templates.webpay_process', $data);
    }

    public function finalPaymentProcess(){
        return view('frontend.final', $this->data);
    }
}
