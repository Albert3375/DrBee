<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\PayerInfo;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Exception\PayPalConnectionException;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

require('../vendor/autoload.php');

class PayPalController extends Controller
{
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['AcUBYX4Yo6MkzXKNCu36-ZI5481zxnRfrPQok1N6TcP_VgtRXgPQyoxY36qPQAAXkDD3gO2LLBteI1SG'],
                $paypal_conf['ED7SDygNCGv0B-d-ji5vZphWLHpAfGUivS0LtGCuaau4TtJCqxYLkiTYXwScC29Yo5yIVChZPQ2hoTEJ']
            )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function payWithpaypal()
    {
        $amountToBePaid = 100;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Mobile Payment')
            /** item name **/
            ->setCurrency('MXN')
            ->setQuantity(1)
            ->setPrice($amountToBePaid);
        /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('MXN')
            ->setTotal($amountToBePaid);
        $redirect_urls = new RedirectUrls();
        /** Specify return URL **/
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (PayPalConnectionException $ex) {
            if (Config::get('app.debug')) {
                Session::put('error', 'Connection timeout');
                return Redirect::route('/');
            } else {
                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('/');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        Session::put('error', 'Unknown error occurred');
        return Redirect::route('/');
    }

    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->PayerID) || empty($request->token)) {
            session()->flash('error', 'Payment failed');
            return Redirect::route('/');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            session()->flash('success', 'Payment success');
            return Redirect::route('/');
        }
        session()->flash('error', 'Payment failed');
        return Redirect::route('/');
    }

    public function store(Request $request)
    {
        $clientId = "<<PAYPAL-CLIENT-ID>>";
        $clientSecret = "<<PAYPAL-CLIENT-SECRET>>";

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => "100.00",
                    "currency_code" => "MXN"
                ]
            ]],
            "application_context" => [
                "cancel_url" => "https://example.com/cancel",
                "return_url" => "https://example.com/return"
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            print_r($response);
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
}
