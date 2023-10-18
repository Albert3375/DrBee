<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Product;
use App\Models\OrderUser;
use App\Models\OrderGuest;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index()
    {
        $data = [];
        $products = Product::latest()->get();

        $user_orders = OrderUser::latest()->get();
        $guest_orders = OrderGuest::latest()->get();

        $orders = [];

        foreach ($user_orders as $user_order) {
            array_push($orders,  $user_order);
        }

        foreach ($guest_orders as $guest_order) {
            array_push($orders, $guest_order);
        }

        return view('admin.reports.index', compact('products', 'orders', 'data'));
    }

    public function usersReport()
    {
        $users = User::latest()->get();
        $myid = Auth::user()->id;

        return view('admin.reports.users', compact('users','myid'));
    }

    public function getBestSellerProducts(Request $request)
    {
        $products = [];

        $users_orders = OrderUser::whereBetween('created_at', [$request->startDate, $request->endDate])->get();

        $guest_orders = OrderGuest::whereBetween('created_at', [$request->startDate, $request->endDate])->get();

        foreach($users_orders as $uo) {
            foreach(json_decode($uo->products) as $product) {
                array_push($products, $product);
            }
        }

        foreach($guest_orders as $go) {
            foreach(json_decode($go->products) as $product) {
                array_push($products, $product);
            }
        }

        $productsCollection = collect($products);

        $data = $productsCollection->groupBy('name')->mapWithKeys(function ($group, $key) {
            return [
                $key => $group->sum('quantity')
            ];
        })->sortDesc()->take($request->number)->toArray();

        return view('admin.reports.index', compact('data'));
    }

    public function download($data)
    {
        $products = ['data' => $data];
        $pdf = PDF::loadView('admin.reports.products',$products);

        return $pdf->download('Reporte de Productos.pdf');

        // return $pdf->stream();
    }
}
