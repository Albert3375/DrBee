<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\OrderGuest;
use App\Models\OrderUser;
use App\Models\User;
use App\Notifications\SendPurchaseOrderNotification;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {

            $id = Auth::user()->id;
            $orders = OrderGuest::latest()->get();

            $users = User::latest()->get();

            foreach ($orders as $order) {
                foreach ($users as $user) {
                    if($order->user_id == $user->id) {
                        $order->user = $user->name;
                    }
                }
            }

            return view('admin.purchaseorder.index', compact('orders', 'id'));
        } else if (Auth::user()->hasRole('user')) {

            $id = Auth::user()->id;
            $orders = OrderUser::where('user_id', $id)->latest()->get();

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
    }

    public function download($id)
    {
        $order = OrderUser::find($id);
        $products = json_decode($order->products);
        $status = OrderUser::$Status;

        $user = DB::table('users')->where('id', $order->user_id)->get()->first();
        $address = DB::table('adresses')->where('id', $order->address_id)->get()->first();

        $data = [
            'order' => $order,
            'user' => $user,
            'address' => $address,
            'products' => $products,
            'status' => $status
        ];

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        $pdf = PDF::loadView('admin.reports.orderUser', $data);

        // return $pdf->download();

        return $pdf->download('Orden de Compra - ' . $order->id . '.pdf');
    }

    public function downloadOrderGuest($id)
    {
        $order = OrderGuest::find($id);
        $products = json_decode($order->products);
        $status = OrderGuest::$Status;

        // dd($order);

        $data = [
            'order' => $order,
            'products' => $products,
            'status' => $status
        ];

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        //return View('admin.reports.orderGuest', $data);

        $pdf = PDF::loadView('admin.reports.orderGuest', $data);

        // return $pdf->download();

        return $pdf->download('Orden de Compra - ' . $order->id . '.pdf');
    }

    public function sendByEmail($id)
    {
        $order = OrderUser::find($id);
        $products = json_decode($order->products);
        $status = OrderUser::$Status;
        $data = [
            'order' => $order,
            'products' => $products,
            'status' => $status
        ];

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        $pdf = PDF::loadView('admin.reports.orderGuest', $data)->setPaper('a4');
        $pdf->save('' . $path . 'Orden de Compra - ' . $order->id . '.pdf');

        $data = $order;
        $user = User::where('id', $order->user_id)->get()->first();

        $user->email = $user->email;
        $user->notify(new SendPurchaseOrderNotification($user, $data, $order));

        $user->email = $user->email;
        $user->email = 'isanchez@ia-society.com';
        $user->notify(new SendPurchaseOrderNotification($user, $data, $order));

        $user->email = $user->email;
        $user->email = 'mcasanova@itconsultoria.com.mx';
        $user->notify(new SendPurchaseOrderNotification($user, $data, $order));

        flash('Orden de Compra enviada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function store(Request $request, User $user)
    {
        $cart_products = session()->get('cart');

        $order = new PurchaseOrder();
        $order->user_id = $request->user_id;
        $order->payment_method = $request->payment_method;
        $order->products = json_encode($cart_products);
        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->billing_address = $request->billing_address;
        $order->city = $request->city;
        $order->zipcode = $request->zipcode;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->save();

        //$email = $request->customer_email;
        $products = json_decode($order->products);

        $request->session()->flush();

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        $pdf = PDF::loadView('admin.reports.orderGuest', $order)->setPaper('a4');

        $pdf->save('' . $path . 'Orden de Compra - ' . $order->id . '.pdf');

        $data = $order;

        $user = User::where('id', $order->user_id)->get()->first();
        $user->email = $user->email;
        // $user->email = 'isanchez@ia-society.com';
        $user->notify(new SendPurchaseOrderNotification($user, $products, $order));

        // $user->email = $user->email;
        $user->email = 'isanchez@ia-society.com';
        $user->notify(new SendPurchaseOrderNotification($user, $products, $order));

        $user->email = 'mcasanova@itconsultoria.com.mx';
        $user->notify(new SendPurchaseOrderNotification($user, $products, $order));

        // return view('web.index', compact('order'));

        return view('web.confirmation');
    }

    public function show($id)
    {
        $order = DB::table('order_guest')->where('id', $id)->get()->first();
        //return $order;
        $products = json_decode($order->products);
        $status = OrderGuest::$Status;

        return view('admin.purchaseorder.show_products_guest', compact('order', 'products', 'status'));
    }

    public function destroy($id)
    {
        OrderGuest::destroy($id);

        flash('Pedido eliminado correctamente.')->success()->important();

        return redirect('admin/orders');
    }
}
