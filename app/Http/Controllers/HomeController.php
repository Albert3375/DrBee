<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Category;
use App\Models\OrderUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'user', 'warehouse', 'manager']);

        $users = User::latest()->get();
        $clients = User::where('surname','User')->latest()->get();
        $products = Product::latest()->get();
        $deliveries = Delivery::latest()->get();
        $categories = Category::latest()->get();
        $sales = Delivery::where('status','completed')->latest()->get();

        $id = Auth::user()->roles_id;
        $user_id = Auth::user()->id;

        $orders = DB::table('order_user')->where('user_id', $user_id)->latest()->get();

        return view('admin.index', compact('users','clients','products','deliveries','categories','sales','id', 'orders'));
    }
}
