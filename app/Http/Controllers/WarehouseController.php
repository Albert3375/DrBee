<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\OrderGuest;
use App\Models\OrderUser;
use App\Models\Product;
use App\Models\User;
use DB;

class WarehouseController extends Controller
{
    public function index()
    {
        $user_orders = OrderUser::latest()->get();
        $guest_orders = OrderGuest::latest()->get();

        $orders = [];

        foreach ($user_orders as $user_order) {
            array_push($orders,  $user_order);
        }

        foreach ($guest_orders as $guest_order) {
            array_push($orders, $guest_order);
        }

        return view('admin.warehouse.index');
    }

    public function warehouseControl()
    {
        $user_orders = OrderUser::latest()->get();
        $guest_orders = OrderGuest::latest()->get();

        $orders = [];

        $products = [];

        /*foreach ($user_orders as $user_order) {
            $user_order = json_decode($user_order->products);
            array_push($orders,  $user_order);
            array_push($products,  $user_order);
        }*/

        /*foreach ($guest_orders as $guest_order) {
            $guest_order = json_decode($guest_order->products);
            array_push($orders, $guest_order);
            array_push($products, $guest_order);
        }*/

        return view('admin.warehouse.control', compact('user_orders', 'guest_orders', 'orders', 'products'));
    }

    public function warehousePendings()
    {
        $user_orders = OrderUser::latest()->get();
        $guest_orders = OrderGuest::latest()->get();

        return view('admin.warehouse.pendings', compact('user_orders', 'guest_orders'));
    }

    public function warehouseHistory()
    {
        $user_orders = OrderUser::latest()->get();
        $guest_orders = OrderGuest::latest()->get();

        $orders = [];

        // foreach ($user_orders as $user_order) {
        //     array_push($orders,  $user_order);
        // }

        // foreach ($guest_orders as $guest_order) {
        //     array_push($orders, $guest_order);
        // }

        // dd($orders);

        return view('admin.warehouse.history', compact('user_orders', 'guest_orders'));
    }
    public function confirmationWarehouse()
    {
        if ($_POST['type'] == 'G') {
            $order = OrderGuest::find($_POST['id']);
            $order->status = 1;
            $order->save();
            return $order->status;
        } elseif ($_POST['type'] == 'U') {
            $order = OrderUser::find($_POST['id']);
            // return $order->status;
            $order->status = 1;
            $order->save();
            return $order->status;
        }
    }

    public function reportarWarehouse()
    {
        if ($_POST['type'] == 'G') {
            $order = OrderGuest::find($_POST['id']);
            $order->status = 2;
            $order->save();
        } elseif ($_POST['type'] == 'U') {
            $order = OrderUser::find($_POST['id']);
            $order->status = 2;
            $order->save();
        }

        return $order->status;
    }

    public function getProductGuest()
    {
        $order = OrderGuest::find($_GET['id']);
        $total = 0;
        $output = ' <table class="table_products">
                        <thead class="">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Piezas</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach (json_decode($order->products) as $id => $product) {
            $total = $total + $product->quantity;
            $output .= '<tr align="center">
                            <td>' . $id . '</td>
                            <td>' . $product->name . '</td>
                            <td>' . $product->quantity . ' items</td>
                        </tr>';
        }
        $output .= '<tr>
                        <td></td>
                        <td><b>Total</b></td>
                        <td>' . $total . ' items</td>
                    </tr>
                </tbody>
            </table>';
            
        return $output;
    }

    public function getProductUser()
    {
        $order = OrderUser::find($_GET['id']);
        $total = 0;
        $output = ' <table class="table_products">
                        <thead class="">
                            <th scope="col">Id</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Piezas</th>
                        </thead>
                        <tbody>';
        foreach (json_decode($order->products) as $id => $product) {
            $total = $total + $product->quantity;
            $output .= '<tr align="center">
                                        <td>' . $id . '</td>
                                        <td>' . $product->name . '</td>
                                        <td>' . $product->quantity . ' items</td>
                                    </tr>';
        }
        $output .= '        <tr>
                                    <td></td>
                                    <td><b>Total</b></td>
                                    <td>' . $total . ' items</td>
                                </tr>
                            </tbody>
                        </table>';
        return $output;
    }
}
