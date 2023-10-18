<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $method = 'CREATE';
        return view('admin.categories.create', compact('method'));
    }

    public function store(Request $request)
    {
        $categories = new Category();
        $categories->name = $request->name;
        $categories->percentage = $request->percentage;
        $categories->save();

        return redirect('admin/categories');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->get()->first();
        $method = 'EDIT';

        return view('admin.categories.edit', compact('method', 'category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $id)->get()->first();
        $category->name = $request->name;
        $category->percentage = $request->percentage;
        $category->save();

        $categories = Category::latest()->get();

        flash('Categoría editado correctamente.')->success()->important();

        return view('admin.categories.index', compact('categories'));
    }

    public function destroy($id)
    {
        Category::destroy($id);

        DB::table('products')->where('category_id', $id)->delete();

        flash('Categoría eliminada correctamente.')->success()->important();

        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }
}
