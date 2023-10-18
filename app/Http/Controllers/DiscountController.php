<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discount = Discount::get()->first();
        return view('admin.discount.index', compact('discount'));
    }

    public function edit($id)
    {
        $discount = Discount::where('id', $id)->get()->first();
        $method = 'EDIT';

        return view('admin.discount.edit',compact('discount', 'method'));
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::where('id', $id)->get()->first();

        $discount->value = $request->value;
        $discount->save();

        flash('Descuento actualizado correctamente.')->success()->important();

        return redirect('admin/discount');
    }
}
