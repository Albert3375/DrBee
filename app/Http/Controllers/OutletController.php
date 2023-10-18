<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Session;
// use Ixudra\Curl\Facades\Curl;

class OutletController extends Controller
{
    public function index(Request $request)
    {
        // $cart = Session::where('session_estatus', session_id())->get();
        // $response = Curl::to('https://ladymoon.com.mx/api/products')->get();

        // $products = json_decode($response);

        // return view('web.outlet', compact('products', 'cart'));
    }
}
