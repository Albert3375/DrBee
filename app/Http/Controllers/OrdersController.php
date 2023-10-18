<?php

namespace App\Http\Controllers;

use App\Models\OrderGuest;
use App\Models\OrderUser;
use App\Models\Product;
use App\Models\Session;
use App\Models\User;
use App\Notifications\PurchaseOrderGuest;
use Illuminate\Support\Facades\DB;
use App\Notifications\PurchaseOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Models\Coupon;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $orders = OrderUser::latest()->get();

        $users = User::latest()->get();

        foreach ($orders as $order) {
            foreach ($users as $user) {
                if($order->user_id == $user->id) {
                    $order->user = $user->name;
                }
            }
        }

        return view('admin.purchaseorder.index_users', compact('orders', 'id'));
    }

    public function storeGuest(Request $request,  User $user)
    {
        // Cupón
        if (isset($request->coupon) !== null) {
            $coupon_name = strtoupper($request->coupon);
            $coupon = Coupon::where('name', $coupon_name)->get()->first();
        }

        // Items de los productos en el cart
        $items = Session::where('session_estatus', session_id())->get();

        // Save order
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
            'status_pay' => '1',
        ]);

        if ($request->pay_method == 'Tarjeta') {

            $httpRequest = new HttpRequest();
            $httpRequest->name = $request->fname . ' ' . $request->lname;
            $httpRequest->email = $request->email;
            $httpRequest->order_id = $order->id;
            $httpRequest->token_id = $request->token_id;
            $httpRequest->total = $request->total;
            $httpRequest->street = $request->billing_address;
            $httpRequest->municipality = $request->city;
            $httpRequest->state = 'SN';

            $conektaController = new ConektaController();
            $paymentConekta = $conektaController->payWithConekta($httpRequest);
            
            $paymentConekta = $paymentConekta->getData();

            if ( $paymentConekta->ok ) {
                // All OK - status paid
                $order->status_pay = '2';
                $order->save();
                // Response msg
                $title_response = '¡Pago exitoso!';
                $message_response = 'Su compra con tarjeta fue procesada exitosamente';
            } else {
                return response()->json(['ok' => false, 'message' => $paymentConekta->response]);
            }

        } else if ($request->pay_method == 'Efectivo' || $request->pay_method == 'Transferencia') {
            // Response msg
            $title_response = '¡Compra registrada!';
            $message_response = 'Nos quedamos a la espera de recibir su comprobante de pago';
        } else if ($request->pay_method == 'Paypal') {
            // All OK - status paid
            $order->status_pay = '2';
            $order->save();
            // Response msg
            $title_response = '¡Pago exitoso!';
            $message_response = 'Su compra con Paypal fue procesada exitosamente';
        }

        // Add items to products y discount stock
        foreach ($items as $product) {
            // Find product
            $product_item = Product::find($product->product_id);
            // Add array products
            $products[] = $product_item;
            // Discount the stock
            $product_item->stock = ($product_item->stock - $product->quantity);
            $product_item->save();
        }

        // 1=Pendiente, 2=Pagado, 3=Enviado, 4=Rechazado, 5=Devolución
        $status = OrderUser::$Status;

        // Data address
        $address = new \stdClass();
        $address->title = $request->billing_address;
        $address->city = $request->city;
        $address->zipcode = $request->zipcode;

        // Preparete generate PDF
        $data = [
            'order' => $order,
            'products' => $products,
            'status' => $status
        ];

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        $pdf = PDF::loadView('admin.reports.orderGuest', $data, compact('user', 'address'))->setPaper('a4');
        $pdf->save('' . $path . 'Orden de Compra - ' . $order->id . '.pdf');

        // Send email confirmation order
        $user->email = $request->email;
        $user->notify(new PurchaseOrderGuest($order, $products));
        // $user->email = 'ventas@zoofish.com.mx';
        $user->email = 'isanchez@ia-society.com';
        $user->notify(new PurchaseOrderGuest($order, $products));

        $user->email = 'mcasanova@itconsultoria.com.mx';
        $user->notify(new PurchaseOrderGuest($order, $products));

        $user->email = 'michcasanov@gmail.com';
        $user->notify(new PurchaseOrderGuest($order, $products));

        // Clear data order    
        foreach ($items as $product) {
            $product->delete();
        }

        session_destroy();

        return response()->json(['ok' => true, 'title' => $title_response, 'message' => $message_response]);

    }

    public function storeOrderUser(Request $request, User $user)
    {
        // Check sesión
        if ( !Auth::check() ) {
            return response()->json(['ok' => false, 'message' => 'El usuario no ha iniciado sesión']);
        }

        // Items de los productos en el cart
        $items = Session::where('session_estatus', session_id())->get();

        // Save order
        $order = OrderUser::create([
            'user_id' => Auth::user()->id,
            'address_id' => $request->address_id,
            'payment_method' => $request->pay_method,
            'products' => json_encode($items),
            'total' => $request->total,
            'status_pay' => '1'
        ]);

        // Find data
        $user = User::find( Auth::user()->id );
        $address = DB::table('adresses')->where('users_id', $user->id)->get()->first();

        if ($request->pay_method == 'Tarjeta') {    

            $httpRequest = new HttpRequest();
            $httpRequest->name = $user->name;
            $httpRequest->email = $user->email;
            $httpRequest->order_id = $order->id;
            $httpRequest->token_id = $request->token_id;
            $httpRequest->total = $request->total;
            $httpRequest->street = $address->street;
            $httpRequest->municipality = $address->municipality;
            $httpRequest->state = $address->state;

            $conektaController = new ConektaController();
            $paymentConekta = $conektaController->payWithConekta($httpRequest);
            
            $paymentConekta = $paymentConekta->getData();

            if ( $paymentConekta->ok ) {
                // All OK - status paid
                $order->status_pay = '2';
                $order->save();
                // Response msg
                $title_response = '¡Pago exitoso!';
                $message_response = 'Su compra con tarjeta fue procesada exitosamente';
            } else {
                return response()->json(['ok' => false, 'message' => $paymentConekta->response]);
            }

        } else if ($request->pay_method == 'Efectivo' || $request->pay_method == 'Transferencia') {
            // Response msg
            $title_response = '¡Compra registrada!';
            $message_response = 'Nos quedamos a la espera de recibir su comprobante de pago';
        } else if ($request->pay_method == 'Paypal') {
            // All OK - status paid
            $order->status_pay = '2';
            $order->save();
            // Response msg
            $title_response = '¡Pago exitoso!';
            $message_response = 'Su compra con Paypal fue procesada exitosamente';
        }

        // Add items to products y discount stock
        foreach ($items as $product) {
            // Find product
            $product_item = Product::find($product->product_id);
            // Add array products
            $products[] = $product_item;
            // Discount the stock
            $product_item->stock = ($product_item->stock - $product->quantity);
            $product_item->save();
        }

        // 1=Pendiente, 2=Pagado, 3=Enviado, 4=Rechazado, 5=Devolución
        $status = OrderUser::$Status;

        // Preparete generate PDF
        $data = [
            'order' => $order,
            'products' => $products,
            'status' => $status
        ];

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        $pdf = PDF::loadView('admin.reports.orderUser', $data, compact('user', 'address'))->setPaper('a4');
        $pdf->save('' . $path . 'Orden de Compra - ' . $order->id . '.pdf');

        // Send email confirmation order
        $user->email = $user->email;
        $user->notify(new PurchaseOrderNotification($user, $products, $order));
        // $user->email = 'ventas@zoofish.com.mx';
        $user->email = 'isanchez@ia-society.com.mx';
        $user->notify(new PurchaseOrderNotification($user, $products, $order)); 

        $user->email = 'mcasanova@itconsultoria.com.mx';
        $user->notify(new PurchaseOrderNotification($user, $products, $order)); 
        
        // Clear data order
        foreach ($items as $product) {
            $product->delete();
        }

        session_destroy();

        return response()->json(['ok' => true, 'title' => $title_response, 'message' => $message_response]);
    }

    public function show($id)
    {
        $order = OrderUser::find($id);
        $status = OrderUser::$Status;

        $user = DB::table('users')->where('id', $order->user_id)->get()->first();
        $address = DB::table('adresses')->where('id', $order->address_id)->get()->first();

        return view('admin.purchaseorder.show_products', compact('order', 'status', 'user', 'address'));
    }

    public function destroy($id)
    {
        OrderUser::destroy($id);

        flash('El Pedido fue eliminado correctamente.')->success()->important();

        $orders = OrderUser::latest()->get();

        return view('admin.purchaseorder.index_users', compact('orders'));
    }

    public function userInformation($id)
    {
        $user = DB::table('users')->where('id', $id)->get()->first();
        return view('admin.purchaseorder.show_user', compact('user'));
    }

    public function adressInformation($id)
    {
        $adress = DB::table('adresses')->where('id', $id)->get()->first();
        return view('admin.purchaseorder.show_adress', compact('adress'));
    }

    public function updateStatusOrder()
    {
        $order = OrderUser::find($_POST['id']);
        $order->status_pay = $_POST['status'];
        $order->save();

        return $order->status_pay;
    }

    public function updateStatusOrderGuest()
    {
        $order = OrderGuest::find($_POST['id']);

        $order->status_pay = $_POST['status'];
        $order->save();

        return $order->status_pay;
    }

    public function download($id)
    {
        $order = OrderUser::find($id);
        $status = OrderUser::$Status;

        $user = DB::table('users')->where('id', $order->user_id)->get()->first();
        $address = DB::table('adresses')->where('id', $order->address_id)->get()->first();

        $data = [
            'order' => $order,
            'user' => $user,
            'address' => $address,
            'status' => $status
        ];

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        $pdf = PDF::loadView('admin.reports.orderUser', $data);

        return $pdf->download('Orden de Compra - ' . $order->id . '.pdf');
    }

    public function sendByEmail($id)
    {
        $order = OrderGuest::find($id);
        $status = OrderGuest::$Status;
        $products = json_decode($order->products);

        foreach ($products as $product) {
            $products[] = Product::find($product->product_id);
        }

        $user = new User();
        $user->name = $order->fname;
        $user->surname = $order->lname;
        $user->phone = $order->phone;
        $user->email = $order->email;

        $data = [
            'order' => $order,
            'user' => $user,
            'products' => $products,
            'status' => $status
        ];

        $address = new \stdClass();
        $address->title = $order->billing_address;
        $address->city = $order->city;
        $address->zipcode = $order->zipcode;

        $order->address = $address;
        $order->payment_method = $order->payment_method;

        $order->user = $user;

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        $data = $order;

        $pdf = PDF::loadView('admin.reports.orderGuest',$data)->setPaper('a4');
        $pdf->save(''.$path.'Orden de Compra - '.$order->id.'.pdf');

        $user->email = $order->email;
        $user->notify(new PurchaseOrderGuest($order, $products));

        $user->email = 'isanchez@ia-society.com';
        $user->notify(new PurchaseOrderGuest($order, $products));

        $user->email = 'mcasanova@itconsultoria.com.mx';
        $user->notify(new PurchaseOrderGuest($order, $products));

        flash('Orden de Compra enviada correctamente.')->success()->important();

        return redirect()->back();
    }
}
