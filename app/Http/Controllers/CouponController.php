<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Category;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        $categories = Category::all();

        foreach ($coupons as $coupon) {
            foreach ($categories as $category) {
                if ($coupon->category == $category->id) {
                    $coupon->category = $category->name;
                }
            }
        }

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $method = 'CREATE';
        $category = Category::all()->pluck('name', 'id')->toArray();

        return view('admin.coupons.create', compact('method', 'category'));
    }

    public function store(Request $request)
    {
        $coupon = new Coupon();

        $coupon->name = $request->name;
        $coupon->category = $request->category;
        $coupon->duration = $request->duration;
        $coupon->quantity = $request->quantity;
        $coupon->validation = $request->validation;
        $coupon->is_active = '1';
        $coupon->save();

        flash('Cupón creado correctamente.')->success()->important();

        return redirect('admin/coupons');
    }

    public function edit($id)
    {
        $coupon = Coupon::where('id', $id)->get()->first();
        $method = 'EDIT';

        return view('admin.coupons.edit', compact('method', 'coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::where('id', $id)->get()->first();

        $coupon->name = $request->name;
        $coupon->category = $request->category;
        $coupon->duration = $request->duration;
        $coupon->quantity = $request->quantity;
        $coupon->validation = $request->validation;
        $coupon->is_active = '1';
        $coupon->save();

        flash('Cupón editado correctamente.')->success()->important();

        return redirect('admin/coupons');
    }

    public function destroy($id)
    {
        Coupon::destroy($id);

        flash('Cupón eliminado correctamente.')->success()->important();

        return redirect()->back();
    }
}
