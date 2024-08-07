<?php

namespace App\Helpers;

use App\Models\Session;
use App\Models\PriceRules;
use Illuminate\Support\Facades\Session as HttpSession;

class CartHelper
{
    public static function addProduct($product, $quantity = 1)
    {
        $session_id = HttpSession::getId();

        // Check if the product is already in the cart
        $cartItem = Session::where('session_estatus', $session_id)->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update the quantity of the existing product in the cart
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Add the new product to the cart
            Session::create([
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "discount" => isset($product->discount) ? $product->discount : 0,
                "price" => $product->price,
                "img" => $product->image,
                "category_id" => $product->category_id,
                'session_estatus' => $session_id,
            ]);
        }

        // Recalculate discounts based on the total quantity in the cart
        self::recalculateDiscounts($session_id, $product->category_id);
    }

    protected static function recalculateDiscounts($session_id, $category_id)
    {
        $totalQuantity = Session::where('session_estatus', $session_id)->sum('quantity');
        $priceRules = PriceRules::where('category_id', $category_id)->get();

        // Apply discounts based on the total quantity in the cart
        $cartItems = Session::where('session_estatus', $session_id)->get();
        foreach ($cartItems as $item) {
            foreach ($priceRules as $rule) {
                if ($totalQuantity >= $rule->quantityPerPackage) {
                    $item->priceDiscount = $rule->priceDiscount;
                    $item->discount = $rule->savedTotal;
                } else {
                    $item->priceDiscount = 0.00;
                    $item->discount = 0.00;
                }
                $item->save();
            }
        }
    }

    public static function getProducts()
    {
        $session_id = HttpSession::getId();
        return Session::where('session_estatus', $session_id)->get();
    }

    public static function clearCart()
    {
        $session_id = HttpSession::getId();
        Session::where('session_estatus', $session_id)->delete();
    }

    
}
