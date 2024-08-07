<?php

namespace App\Http\Controllers;

use Conekta\Conekta;
use App\Helpers\UserCartHelper;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Asegúrate de importar el facade de logging

class ConektaController extends Controller
{
    public function payWithConekta(Request $request)
    {
        // Configurar Conekta
        Conekta::setApiKey(env('CONEKTA_PRIVATE_KEY'));
        Conekta::setApiVersion('2.0.0');
        Conekta::setLocale('es');

        // Validar la solicitud utilizando un validador
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'pay_method' => 'required|in:Tarjeta,Efectivo,Transferencia,Paypal',
            'total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'message' => $validator->errors()->first()]);
        }

// Recuperar productos del carrito utilizando el helper
$items = UserCartHelper::getProducts();

// Asegúrate de que $items sea una colección o un arreglo
if (is_array($items)) {
    $itemCount = count($items);
} elseif ($items instanceof \Illuminate\Support\Collection) {
    $itemCount = $items->count();
} else {
    $itemCount = 0;
}

// Logging para depuración
Log::info('Productos en el carrito antes del pago:', ['items' => $items]);

if ($itemCount == 0) {
    return response()->json(['ok' => false, 'message' => 'No hay productos en el carrito']);
}

// Continuar con el procesamiento de la orden si hay productos


        // Crear la orden del usuario utilizando el helper
        $order = UserCartHelper::createOrder(
            Auth::user()->id,
            $request->address_id,
            $request->pay_method,
            $request->total
        );

        // Verificar el método de pago y procesarlo
        switch ($request->pay_method) {
            case 'Tarjeta':
                $paymentResult = $this->processCreditCardPayment($order, $request);
                if (!$paymentResult['ok']) {
                    return response()->json(['ok' => false, 'message' => $paymentResult['message']]);
                }
                $title_response = '¡Pago exitoso!';
                $message_response = 'Su compra con tarjeta fue procesada exitosamente';
                break;
            case 'Efectivo':
            case 'Transferencia':
                $title_response = '¡Compra registrada!';
                $message_response = 'Nos quedamos a la espera de recibir su comprobante de pago';
                break;
            case 'Paypal':
                // Implementar proceso de pago con Paypal si es necesario
                $order->status_pay = '2'; // Por ejemplo, actualizar el estado de pago
                $order->save();
                $title_response = '¡Pago exitoso!';
                $message_response = 'Su compra con Paypal fue procesada exitosamente';
                break;
            default:
                return response()->json(['ok' => false, 'message' => 'Método de pago no válido']);
        }

        // Actualizar el stock de productos (implementa esta función según tu lógica)
        // $this->updateProductStock($items);

        // Generar PDF (implementa esta función según tu lógica)
        // $this->generatePDF($order, $items, 'user');

        // Limpiar el carrito utilizando el helper
        UserCartHelper::clearCart();

        // Respuesta exitosa
        return response()->json(['ok' => true, 'title' => $title_response, 'message' => $message_response]);
    }

    // Función para procesar el pago con tarjeta (debes implementarla según Conekta)
    private function processCreditCardPayment($order, $request)
    {
        try {
            // Ejemplo de cómo podrías implementar el pago con Conekta
            $charge = \Conekta\Order::create([
                'currency' => 'MXN',
                'customer_info' => [
                    'customer_id' => Auth::user()->conekta_customer_id // Ejemplo de cómo obtener el ID del cliente de Conekta
                ],
                'line_items' => [
                    [
                        'name' => 'Compra en mi tienda',
                        'unit_price' => $order->total * 100, // El total debe estar en centavos
                        'quantity' => 1,
                    ],
                ],
                'charges' => [
                    [
                        'payment_method' => [
                            'type' => 'card',
                            'token_id' => $request->token_id, // Token de tarjeta generado por Conekta
                        ],
                    ],
                ],
            ]);

            // Si el pago se realiza con éxito
            if ($charge->payment_status == 'paid') {
                return ['ok' => true];
            } else {
                return ['ok' => false, 'message' => 'El pago no pudo ser procesado'];
            }
        } catch (\Conekta\Handler $error) {
            return ['ok' => false, 'message' => $error->getMessage()];
        }
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
                return response()->json(['error' => $error->getMessage()], 400);
            } catch (\Conekta\Handler $error) {
                return response()->json(['error' => $error->getMessage()], 400);
            }

            $user->conekta_customer_id = $customer->id;
            $user->save();

            $cards = $customer->payment_sources;
        } else {
            $customer = \Conekta\Customer::find($user->conekta_customer_id);

            $cards = $customer->payment_sources;
        }

        return response()->json(['cards' => $cards], 200);
    }
}
