<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adress;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            $cart = Session::where('session_estatus', session_id())->get();
            return view('web.express_purchase', compact('cart'));
        } else {

            $address = Adress::where('users_id', Auth::user()->id)->pluck('title', 'id')->toArray();
            $user_card = DB::table('user_cards')->get()->first();
            $cart = Session::where('session_estatus', session_id())->get();

            return view('web.express_purchase', compact('address', 'user_card', 'cart'));
        }
    }
}
