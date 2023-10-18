<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PriceRules;
use App\Models\Product;
use Illuminate\Http\Request;

class PriceRulesController extends Controller
{
    public function index()
    {
        $rules = PriceRules::all();
        return view('admin.rules_price.index', compact('rules'));
    }

    public function edit($id = 0)
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();
        $priceRule = PriceRules::find($id);

        return view('admin.rules_price.edit', compact('priceRule', 'categories'));
    }

    public function update()
    {
        $priceRule = PriceRules::find($_POST['id']);

        if ($_POST['var'] == 'CostoPorPieza') {
            $priceRule->unitPrice = $_POST['CostoPorPieza'];
        } elseif ($_POST['var'] == 'CantidadPiezasPaquete') {
            $priceRule->quantityPerPackage = $_POST['CantidadPiezasPaquete'];
        } elseif ($_POST['var'] == 'Descuento') {
            $priceRule->discount = $_POST['Descuento'] / 100;
        } elseif ($_POST['var'] == 'AhorroEnvio') {
            $priceRule->costPerPound = $_POST['AhorroEnvio'];
        } elseif ($_POST['var'] == 'Category') {
            $priceRule->category_id = $_POST['Category'];
        }
        // elseif($_POST['var'] == 'PorcentajeDescuento'){
        //     $priceRule->packageDiscount = $_POST['PorcentajeDescuento'] / 100;
        // }
        $priceRule->priceDiscount = $priceRule->unitPrice - ($priceRule->unitPrice * $priceRule->discount);
        $priceRule->packageDiscount = $priceRule->quantityPerPackage * $priceRule->priceDiscount;
        $priceRule->packagePrice = $priceRule->quantityPerPackage * $priceRule->unitPrice;
        $priceRule->savedPurchase = $priceRule->packagePrice - $priceRule->packageDiscount;
        $priceRule->savedTotal = $priceRule->savedPurchase + $priceRule->savedShipping;
        // $priceRule->costPieceWithDiscount = $priceRule->totalPackageWithDiscount / $priceRule->quantityPerPackage;
        $priceRule->save();

        return 'vas bien morra';
    }
}
