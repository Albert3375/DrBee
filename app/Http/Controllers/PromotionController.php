<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\User;
use App\FileControl\FileControl;
use DB;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::latest()->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $method = 'CREATE';
        return view('admin.promotions.create', compact('method'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $fileName = FileControl::storeSingleFile($request->image, 'promotionsPictures');
            $request->image = "/promotionsPictures/{$fileName}";
        }

        $promotion = new Promotion();
        $promotion->name = $request->name;
        $promotion->description = $request->description;
        $promotion->image = $request->image;
        $promotion->valitidy = $request->valitidy;
        $promotion->save();

        flash('Promoción guardada correctamente.')->success()->important();

        return redirect('admin/promotions');
    }

    public function edit($id)
    {
        $method = 'EDIT';
        $promotion = Promotion::find($id);

        return view('admin.promotions.edit', compact('method','promotion'));
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::find($id);

        if ($request->hasFile('image')) {
            $fileName = FileControl::storeSingleFile($request->image, 'promotionsPictures');
            $promotion->image = "/promotionsPictures/{$fileName}";
        }

        $promotion->name = $request->name;
        $promotion->description = $request->description;
        $promotion->valitidy = $request->valitidy;
        $promotion->save();

        flash('Promoción actualizada correctamente.')->success()->important();

        return redirect('admin/promotions');
    }

    public function destroy($id)
    {
        Promotion::destroy($id);

        flash('Promoción eliminada correctamente.')->success()->important();

        return redirect()->back();
    }
}
