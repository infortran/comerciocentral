<?php

namespace App\Http\Controllers;

use App\Comprobante;
use App\Direccion;
use App\Loader;
use App\Orden;
use App\Tienda;
use App\WebpayOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Session;
use Khipu;

class CheckoutController extends Controller
{
    private $data, $ordername;

    public function __construct(){
        /*$data = new Loader();
        $this->data = $data->getData();*/
    }

    public function index(Request $request, $domain){
        if($domain) {
            $loader = new Loader($domain);
            if ($loader->checkDominio()) {
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                //dd($this->generateOrdenNumber($data['tienda']));
                //dd(Session::has($data['cartname']));
                if(Session::has($data['cartname'])){

                    $cart = Session::get($data['cartname']);
                    $total = $cart->precioTotal;
                    if(Session::has($data['envioname'])){
                        $total = $cart->precioTotal + Session::get($data['envioname'])->precio;
                    }

                    $data['cart'] = $cart;
                    $data['total_final'] = $total;
                    return view('frontend.checkout', $data);
                }else{
                    return redirect('/carrito');
                }
            }
        }
        return view('frontend.templates.site-not-found');

    }

    public function getPaymentProcess(Request $request, $domain){

        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominio()){
                $data = $loader->getData();

                if($data['tienda']->id == $request->get('tienda')){
                    $cartname = 'cart-'. $request->get('tienda');
                    $envioname = 'envio-'. $request->get('tienda');
                    $envio = null;
                    $dir_string = null;
                    $nombre = null;
                    if(!Session::has($cartname)){
                        return redirect('/carrito');
                    }

                    if(Session::has($envioname)){
                        $envio = Session::get($envioname)->precio;
                        if(Auth::check() && Auth::user()->direcciones){
                            $direccion = Direccion::find($request->get('direccion_envio'));
                            $dir_string = $direccion->calle.' / ';
                            $dir_string .= $direccion->numero. ' / ';
                            $dir_string .= $direccion->departamento ? $direccion->departamento.' / ' : '' ;
                            $dir_string .= $direccion->poblacion. ' / ';
                            $dir_string .= $direccion->ciudad. '.';
                        }else{
                            $request->validate([
                                'calle' => 'required|regex:[A-Za-z1-9 ]',
                                'numero' => 'required|regex:[A-Za-z1-9 ]',
                                'poblacion' => 'required|regex:[A-Za-z1-9 ]',
                                'ciudad' => 'required|regex:[A-Za-z1-9 ]']);
                            $dir_string = $request->get('calle').' / ';
                            $dir_string .= $request->get('numero'). ' / ';
                            $dir_string .= $request->get('departamento') ? $request->get('departamento').' / ' : '' ;
                            $dir_string .= $request->get('poblacion'). ' / ';
                            $dir_string .= $request->get('ciudad'). '.';
                        }
                    }
                    if(!Auth::check()){
                        $request->validate([
                            'nombre' => 'required|regex:[A-Za-z1-9 ]',
                            'email' => 'required|email|regex:[A-Za-z1-9 ]',
                            'telefono' => 'required|regex:[A-Za-z1-9 ]',
                        ]);
                    }else{
                        $nombre = Auth::user()->name.' '.Auth::user()->lastname;
                    }

                    $cart = Session::get($cartname);
                    $total = $envio ? $cart->precioTotal + $envio : $cart->precioTotal;
                    $orden = new Orden();
                    $orden->number = $this->generateOrdenNumber($data['tienda']);
                    $orden->nombre = $nombre ? $nombre : $request->get('nombre');
                    $orden->email = Auth::check() ? Auth::user()->email : $request->get('email');
                    $orden->telefono = Auth::check() ? Auth::user()->telefono : $request->get('telefono');
                    $orden->user_id = Auth::check() ? Auth::user()->id : null;
                    $orden->cart = serialize($cart);
                    $orden->total = $cart->precioTotal;
                    $orden->envio = $envio;
                    $orden->direccion = $dir_string ?? null;


                    //PAYMENT SELECTOR
                    if($request->get('forma_pago') == 'webpay') {
                        $orden->tipo_pago = 'webpay';
                        $data['tienda']->ordenes()->save($orden);
                        if ($this->getWebpay($total, $orden->number)) {
                            $data['form_action'] = $this->data['form_action'];
                            $data['token_ws'] = $this->data['token_ws'];
                            return view('frontend.templates.payment_process', $data);
                        } else {
                            return redirect('checkout')->withErrors("Error en la autorizacion de WEBPAY");
                        }
                    }elseif($request->get('forma_pago') == 'khipu'){
                        //$orden->tipo_pago = 'khipu';
                        //$data['tienda']->ordenes()->save($orden);
                        return view('frontend.khipu', $data);
                    }else{
                        $orden->tipo_pago = 'deposito';
                        $this->ordername = 'orden-'. $request->get('tienda');
                        Session::put($this->ordername, $orden);
                        return redirect('/payment/deposito');
                    }
                }
            }
        }
    }

    public function generateOrdenNumber($tienda){
        if(count($tienda->ordenes) > 0){
            $ultima = $tienda->ordenes->last();
            return $ultima->number + 1;
            //ver si existe l primera orden
            //si ya hay una orden leer el ID
            // al ID leido sumarle 1
        }else{
            //si no existe genearar el ID 1
            return 1;
        }
    }

    public function showKhipuPayment(Request $request, $domain){
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominio()){
                $loader->checkDominioAdmin();
                $data = $loader->getData();
                return view('frontend.khipu', $data);
            }
        }
        return view('frontend.templates.site-not-found');
    }
    public function getKhipuPayment(){
        $receiverId = 307097;
        $secretKey = '90725e38aaf5dbb47d4783dffc26bd23ed53f24b';

        $configuration = new Khipu\Configuration();
        $configuration->setReceiverId($receiverId);
        $configuration->setSecret($secretKey);
// $configuration->setDebug(true);

        $client = new Khipu\ApiClient($configuration);
        $payments = new Khipu\Client\PaymentsApi($client);

        try {
            $opts = array(
                "transaction_id" => "MTI-100",
                "return_url" => "http://mi-ecomerce.com/backend/return",
                "cancel_url" => "http://mi-ecomerce.com/backend/cancel",
                "picture_url" => "http://mi-ecomerce.com/pictures/foto-producto.jpg",
                "notify_url" => "http://mi-ecomerce.com/backend/notify",
                "notify_api_version" => "1.3"
            );
            $response = $payments->paymentsPost(
                "Compra de prueba de la API", //Motivo de la compra
                "CLP", //Monedas disponibles CLP, USD, ARS, BOB
                100.0, //Monto. Puede contener ","
                $opts //campos opcionales
            );

            print_r($response);
        } catch (\Khipu\ApiException $e) {
            echo print_r($e->getResponseBody(), TRUE);
        }

    }

    public function getDepositoPaymentProcess(Request $request){
        if (Session::has($this->ordername)){
            return view('frontend.templates.deposito', $this->data);
        }else{
            return redirect('/');
        }
    }

    public function finalDepositoProcess(Request $request){
        $request->validate([
            'voucher' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        //comprobar si viene la orden en session
        if(!Session::has('orden')){
            return redirect('/');
        }

        $orden = Session::get('orden');

        $img = $request->file('voucher');

        $imageName = $img->getClientOriginalName(). time().'.'.$img->extension();
        request()->voucher->move(public_path('images/uploads/comprobantes'), $imageName);

        $comprobante = new Comprobante();
        $comprobante->img = $imageName;
        $orden->save();

        $orden->comprobantes()->save($comprobante);
        $this->data['nombre'] = $orden->nombre;
        $this->data['direccion'] = $orden->direccion;
        $this->data['nro_orden'] = 'N°'.$orden->number;
        $this->data['monto'] = $orden->envio ? $orden->envio + $orden->total : $orden->total;
        Session::forget('orden');
        Session::forget('cart');
        return view('frontend.final-deposito', $this->data);
    }

    public function getWebpay($amount, $buyOrder){
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $returnUrl = url('/payment/webpay');
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
            return true;
        }else{
            return false;
        }
    }

    public function webpayProcess(Request $request){
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
            $orden = Orden::where('number', $output->buyOrder)->first();
            //CAMBIAR EL ESTADO DE ORDEN A CONFIRMADO
            $orden->estado = 'pagado';
            $orden->save();
            $orden->webpayOrdens()->save($webpayOrden);
            $data = [
                'card_number' => $result->cardDetail->cardNumber,
                'authorization_code' => $output->authorizationCode,
                'amount' => number_format($output->amount, 0, '', '.'),
                'buy_order' => $output->buyOrder,
                'shares_number' => $output->sharesNumber,
                'response_code' => $output->responseCode,
                'url_redirection' => $result->urlRedirection,
                'token_ws' => $tokenWs,
                'nombre' => $orden->nombre,
                'direccion' => $orden->direccion
            ];
            return view('frontend.templates.webpay_process', $data);
        }else{
            dd($output->responseCode);
        }

    }

    public function finalPaymentProcess(Request $request, $domain){
        //BORRAR LA ORDEN QUE NO FUE PROCESADA
        if($domain){
            $loader = new Loader($domain);
            if($loader->checkDominio()){
                $data = $loader->getData();
                if($request->get('TBK_TOKEN')){
                    $orden = Orden::where('number', $request->get('TBK_ORDEN_COMPRA'))->first();
                    $orden->estado = 'rechazado';
                    $orden->save();
                }
                return view('frontend.final', $data);
            }
        }

    }

    public function getRetryPayment(){
        return view('frontend.templates.retry-payment', $this->data);
    }
}
