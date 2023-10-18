<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CardController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $cards = DB::table('user_cards')->where('user_id', $user_id)->latest()->get();

        return view('admin.payments.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }
}
