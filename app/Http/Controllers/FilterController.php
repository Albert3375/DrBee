<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $filters = Filter::latest()->get();
        $categories = Category::latest()->get();

        foreach ($filters as $filter) {
            foreach($categories as $category) {
                if($filter->category == $category->id) {
                    $filter->category = $category->name;
                }
            }
        }

        return view('admin.filters.index', compact('filters'));
    }

    public function create()
    {
        $method = 'CREATE';
        $category = Category::all()->pluck('name', 'id')->toArray();
        return view('admin.filters.create', compact('method', 'category'));
    }

    public function store(Request $request)
    {
        $filter = new Filter();
        $filter->name = $request->name;
        // $filter->category = $request->category;
        $filter->category = '1';
        $filter->save();

        flash('Filtro guardado correctamente.')->success()->important();

        return redirect('admin/filters');
    }

    public function edit($id)
    {
        $method = 'EDIT';
        $filter = Filter::find($id);
        $category = Category::all()->pluck('name', 'id')->toArray();

        return view('admin.filters.edit', compact('category', 'method', 'filter'));
    }

    public function update(Request $request, $id)
    {
        $filter = Filter::find($id);

        $filter->name = $request->name;
        $filter->category = $request->category_id;
        // $filter->category = '1';
        $filter->save();

        flash('Filtro actualizado correctamente.')->success()->important();

        return redirect('admin/filters');
    }

    public function destroy($id)
    {
        Filter::destroy($id);

        flash('Filtro eliminado correctamente.')->success()->important();

        return redirect()->back();
    }
}
