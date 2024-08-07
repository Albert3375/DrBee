<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Models\OrderGuest;
use App\Models\OrderUser;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as HttpSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Notifications\PurchaseOrderGuest;
use PDF;
use App\Helpers\CartHelper;  // Importar el helper
use App\Helpers\UserCartHelper;  // Importar el helper

class OrdersController extends Controller
{
    public function index()
    {
        $orders = OrderUser::latest()->get();
        return view('admin.purchaseorder.index_users', compact('orders'));
    }

    public function storeGuest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'billing_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'pay_method' => 'required|string|in:Tarjeta,Efectivo,Transferencia,Paypal',
            'total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'message' => $validator->errors()->first()]);
        }

        // Recuperar artículos del carrito usando el helper
        $items = CartHelper::getProducts();

        if (empty($items)) {
            return response()->json(['ok' => false, 'message' => 'No hay productos en el carrito']);
        }

        // Crear la orden del invitado
        $order = OrderGuest::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $request->phone,
            'email' => $request->email,
            'billing_address' => $request->billing_address,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'payment_method' => $request->pay_method,
            'products' => json_encode($items),
            'total' => $request->total,
            'status_pay' => '1', // Suponiendo '1' es para pago completado
        ]);

        $title_response = '';
        $message_response = '';

        try {
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
                    $order->status_pay = '2'; // Suponiendo '2' es para pago pendiente
                    $order->save();
                    $title_response = '¡Pago exitoso!';
                    $message_response = 'Su compra con Paypal fue procesada exitosamente';
                    break;
                default:
                    return response()->json(['ok' => false, 'message' => 'Método de pago no válido']);
            }

            $this->updateProductStock($items);

            // Generar PDF
            $this->generatePDF($order, $items, 'guest');

            // Limpiar los datos de la sesión usando el helper
            CartHelper::clearCart();
            HttpSession::flush();

            return response()->json(['ok' => true, 'title' => $title_response, 'message' => $message_response]);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Error al procesar la compra: ' . $e->getMessage()]);
        }
    }

    public function storeOrderUser(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['ok' => false, 'message' => 'El usuario no ha iniciado sesión']);
        }

        $validator = Validator::make($request->all(), [
            'address_id' => 'required|integer|exists:addresses,id',
            'pay_method' => 'required|string|in:Tarjeta,Efectivo,Transferencia,Paypal',
            'total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            $order = UserCartHelper::createOrder(
                Auth::user()->id,
                $request->address_id,
                $request->pay_method,
                $request->total
            );

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
                    $order->status_pay = '2'; // Suponiendo '2' es para pago pendiente
                    $order->save();
                    $title_response = '¡Pago exitoso!';
                    $message_response = 'Su compra con Paypal fue procesada exitosamente';
                    break;
                default:
                    return response()->json(['ok' => false, 'message' => 'Método de pago no válido']);
            }

            $this->updateProductStock($order->products);

            $this->generatePDF($order, $order->products, 'user');

            UserCartHelper::clearCart();

            return response()->json(['ok' => true, 'title' => $title_response, 'message' => $message_response]);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Error al procesar la compra: ' . $e->getMessage()]);
        }
    }

    private function processCreditCardPayment($order, $request)
    {
        // Implementar procesamiento real del pago con tarjeta aquí
        // Simulación
        return ['ok' => true, 'message' => 'Pago exitoso'];
    }

    private function updateProductStock($items)
    {
        foreach ($items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                if ($product->stock < $item->quantity) {
                    throw new \Exception('Stock insuficiente para el producto ' . $product->name);
                }
                $product->stock -= $item->quantity;
                $product->save();
            }
        }
    }

    private function generatePDF($order, $items, $type)
    {
        $data = [
            'order' => $order,
            'products' => $items,
        ];

        $view = $type === 'guest' ? 'admin.reports.orderGuest' : 'admin.reports.orderUser';

        $ordersPath = public_path('orders');
        if (!file_exists($ordersPath)) {
            mkdir($ordersPath, 0777, true);
        }

        $pdf = PDF::loadView($view, $data)->setPaper('a4');
        $pdfPath = $ordersPath . '/Orden_de_Compra_' . $order->id . '.pdf';
        $pdf->save($pdfPath);
    }

    public function sendByEmail($id)
    {
        $order = OrderGuest::find($id);
        if (!$order) {
            abort(404, 'Order not found');
        }

        $items = json_decode($order->products);

        $products = [];
        foreach ($items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $products[] = $product;
            }
        }

        $user = new User();
        $user->name = $order->fname;
        $user->surname = $order->lname;
        $user->phone = $order->phone;
        $user->email = $order->email;

        $address = new \stdClass();
        $address->title = $order->billing_address;
        $address->city = $order->city;
        $address->zipcode = $order->zipcode;

        $data = [
            'order' => $order,
            'user' => $user,
            'address' => $address,
            'products' => $products,
        ];

        $ordersPath = public_path('orders');
        if (!file_exists($ordersPath)) {
            mkdir($ordersPath, 0777, true);
        }

        $pdf = PDF::loadView('admin.reports.orderGuest', $data)->setPaper('a4');
        $pdfPath = $ordersPath . '/Orden de Compra - ' . $order->id . '.pdf';
        $pdf->save($pdfPath);

        $emails = ['destinatario1@example.com', 'destinatario2@example.com']; // Correos destinatarios
        foreach ($emails as $email) {
            Mail::to($email)->send(new PurchaseOrderGuest($order, $products));
        }

        flash('Orden de Compra enviada correctamente.')->success()->important();
        return redirect()->back();
    }

    private function sendOrderEmails($order, $items)
    {
        $emails = ['destinatario1@example.com', 'destinatario2@example.com']; // Correos destinatarios

        $products = [];
        foreach ($items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $products[] = $product;
            }
        }

        $notification = new PurchaseOrderGuest($order, $products);

        foreach ($emails as $email) {
            Notification::route('mail', $email)->notify($notification);
        }
    }
}
