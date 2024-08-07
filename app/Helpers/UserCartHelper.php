<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\OrderUser;
use Illuminate\Support\Facades\Log;

class UserCartHelper
{
    // Obtener productos del carrito para el usuario autenticado
    public static function getProducts()
    {
        $user = Auth::user();
        if (!$user) {
            Log::warning('Intento de acceso al carrito sin autenticación');
            return collect(); // Retorna una colección vacía si el usuario no está autenticado
        }

        // Recuperar los productos del carrito del usuario
        $products = CartItem::where('user_id', $user->id)->get();
        Log::info('Productos recuperados del carrito:', ['products' => $products->toArray()]);
        return $products;
    }

    // Limpiar el carrito del usuario autenticado
    public static function clearCart()
    {
        $user = Auth::user();
        if ($user) {
            CartItem::where('user_id', $user->id)->delete();
            Log::info('Carrito limpiado para el usuario', ['user_id' => $user->id]);
        }
    }

    // Agregar producto al carrito del usuario autenticado
    public static function addProduct($product, $quantity = 1)
    {
        $user = Auth::user();

        if ($user) {
            // Verificar si el producto ya está en el carrito
            $cartItem = CartItem::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                // Actualizar la cantidad del producto existente en el carrito
                $cartItem->quantity += $quantity;
                $cartItem->save();
                Log::info('Cantidad del producto actualizada en el carrito', ['product_id' => $product->id, 'quantity' => $cartItem->quantity]);
            } else {
                // Agregar el nuevo producto al carrito
                CartItem::create([
                    "user_id" => $user->id,
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "discount" => $product->discount ?? 0,
                    "price" => $product->price,
                    "img" => $product->image,
                    "category_id" => $product->category_id,
                ]);
                Log::info('Nuevo producto agregado al carrito', ['product_id' => $product->id, 'quantity' => $quantity]);
            }
        }
    }

    // Crear una orden para el usuario
    public static function createOrder($user_id, $address_id, $payment_method, $total)
    {
        // Recuperar productos del carrito
        $items = self::getProducts();

        if ($items->isEmpty()) {
            Log::warning('Intento de creación de orden sin productos en el carrito', ['user_id' => $user_id]);
            throw new \Exception('No hay productos en el carrito para crear la orden.');
        }

        // Crear la orden del usuario
        $order = OrderUser::create([
            'user_id' => $user_id,
            'address_id' => $address_id,
            'payment_method' => $payment_method,
            'products' => json_encode($items),
            'total' => $total,
            'status_pay' => '1',
        ]);

        Log::info('Orden creada', ['order_id' => $order->id, 'user_id' => $user_id]);

        return $order;
    }
}
