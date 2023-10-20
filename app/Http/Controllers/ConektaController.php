<?php

namespace App\Http\Controllers;


use Conekta\Conekta;
use App\Models\Adress;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ConektaController extends Controller
{
  public function payWithConekta(Request $request)
  {
    // Config conekta
    Conekta::setApiKey( env('CONEKTA_PRIVATE_KEY') );
    Conekta::setApiVersion('2.0.0');
    Conekta::setLocale('es');

    // Convert centavos
    $total = ($request->total * 100);

    // Create order array
    $charge = [
      'line_items' => [
        [
          'name' => 'Pago de orden NO. ' . $request->order_id,
          'unit_price' => $total,
          'quantity' => 1
        ]
      ],
      'currency' => 'MXN',
      'customer_info' => [],
      'charges' => [
        [
          'payment_method' => [
            'type' => 'default'
          ]
        ]
      ],
      'shipping_lines' => [
        [
          'amount' => 0,
          'carrier' => 'Pendiente',
          'method' => 'Pendiente',
          'tracking_number' => 'ord_' . $request->order_id,
          'object' => 'shipping_line'
        ]
      ],
      'shipping_contact' => [
        'phone' => "55-5555-5555",
        'receiver' => $request->name,
        'between_streets' => 'No indicado',
        'address' => [
            'object' => 'shipping_address',
            'street1' => $request->street,
            'city' => $request->municipality,
            'state' => $request->state,
            'country' => 'Mexico',
            'postal_code' => '01010',
            'residential' => true
        ],
        'object' => 'shipping_contact'
      ]
    ];

    try {

      $customer = \Conekta\Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'payment_sources' => [
          [
            'type' => 'card',
            'token_id' => $request->token_id
          ]
        ]
      ]);

      $charge['customer_info']['customer_id'] = $customer->id;

      // Create order
      $charge = \Conekta\Order::create($charge);

      if ($charge->payment_status == 'paid') {
        return response()->json(['ok' => true, 'response' => $charge]);
      } else {
        return response()->json(['ok' => false, 'response' => $charge->failure_code . ': ' . $charge->failure_message]);
      }
    } catch (\Conekta\ParameterValidationError $error) {
      $error = $error->getMessage();
    } catch (\Conekta\Handler $error) {
      $error = $error->getMessage();
    }

    // Si atrapa un error
    return response()->json(['ok' => false, 'response' => $error]);
  }

  public function addCustomer(Request $request)
  {
    Conekta::setApiKey(env("CONEKTA_PRIVATE_KEY"));
    Conekta::setLocale('es');

    $user = User::find($request->user_id);
    try {
      $customer = \Conekta\Customer::create(
        [
          'name'  => $user->name,
          'email' => $user->email,
          'phone' => $request->phone,
        ]
      );
    } catch (\Conekta\ParameterValidationError $error) {
      $bug = $error->getMessage();
      return response()->json(['bug' => $bug], 200);
    } catch (\Conekta\Handler $error) {
      $bug = $error->getMessage();
      return response()->json(['bug' => $bug], 200);
    }

    $user->conekta_customer_id = $customer->id;
    $user->save();

    return response()->json(['customer' => $customer], 200);
  }

  public function addCard(Request $request)
  {
    Conekta::setApiKey(env("CONEKTA_PRIVATE_KEY"));
    Conekta::setLocale('es');

    $user = User::find(intval(str_replace('"', '', $request->user_id)));

    $customer = \Conekta\Customer::find($user->conekta_customer_id);

    $source = $customer->createPaymentSource([
      'token_id' => $request->conekta_token_id,
      'type'     => 'card'
    ]);

    DB::table('user_cards')->insert(
      [
        'user_id' => $request->user_id,
        'conekta_token_id' => $request->conekta_token_id,
        'parent_id' => $source->parent_id,
        'source_index' => $source->id,
        'last4' => $source->last4,
        'brand' => $source->brand,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now()
      ]
    );

    return $source;
  }

  public function destroyCard(Request $request)
  {
    Conekta::setApiKey(env("CONEKTA_PRIVATE_KEY"));
    Conekta::setLocale('es');

    $user = User::find($request->user_id);
    $customer = \Conekta\Customer::find($user->conekta_customer_id);

    $i = 0;
    foreach ($customer->payment_sources as $payment_source) {
      if ($payment_source->id == $request->source_index) {
        $source = $customer->payment_sources[$i]->delete();
      }
      $i++;
    }

    DB::table('user_cards')->where('id', $request->card_id)->delete();

    flash('Tarjeta eliminada correctamente.')->success()->important();

    return redirect()->back();
  }

  public function getCardsByUser($id)
  {
    Conekta::setApiKey(env("CONEKTA_PRIVATE_KEY"));
    Conekta::setLocale('es');

    $user = User::find($id);

    if (!isset($user->conekta_customer_id)) {
      try {
        $customer = \Conekta\Customer::create([
          'name'  => $user->name,
          'email' => $user->email,
          'phone' => $user->phone,
        ]);
      } catch (\Conekta\ParameterValidationError $error) {
        $bug = $error->getMessage();
        return response()->json(['bug' => $bug], 200);
      } catch (\Conekta\Handler $error) {
        $bug = $error->getMessage();
        return response()->json(['bug' => $bug], 200);
      }

      $user->conekta_customer_id = $customer->id;
      $user->save();
    }

    $customer = \Conekta\Customer::find($user->conekta_customer_id);
    $cards = json_decode($customer->payment_sources);

    return $cards;
  }

  public function getCardById(Request $request)
  {
    Conekta::setApiKey(env("CONEKTA_PRIVATE_KEY"));
    Conekta::setLocale('es');

    $user = User::find($request->user_id);

    $customer = \Conekta\Customer::find($user->conekta_customer_id);

    return response()->json(['cards' => $customer->payment_sources], 200);
  }

  public function addPaymentMethod(Request $request)
  {
    Conekta::setApiKey(env("CONEKTA_PRIVATE_KEY"));
    Conekta::setLocale('es');

    $user = User::find($request->user_id);

    $customer = \Conekta\Customer::find($user->conekta_customer_id);

    $source = $customer->createPaymentSource([
      'token_id' => $request->conekta_token_id,
      'type'     => 'card',
    ]);

    return response()->json(['source' => $source], 200);
  }
}
