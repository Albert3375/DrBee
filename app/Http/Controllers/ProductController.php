<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\NewsLetter;
use App\Notifications\NewsLetterNotification;
use App\Models\Adress;
use App\FileControl\FileControl;
use App\Models\PriceRules;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Models\Filter;
use App\Models\Promotion;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
    
        return view('admin.products.index', compact('products', 'categories'));
    }
    
    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->query('category');
    
        // Si no se proporciona un ID de categoría, obtener todos los productos
        if (!$categoryId || $categoryId == 0) {
            $products = Product::all();
        } else {
            $products = Product::where('category_id', $categoryId)->get();
        }
    
        // Añadir información adicional como comentarios y calificaciones
        $products->transform(function ($product) {
            $comments = Comment::where('products_id', $product->id)->get();
            $rating = 0;
            if ($comments->count() > 0) {
                foreach ($comments as $comment) {
                    $rating += $comment->rating;
                }
                $rating = ($rating / $comments->count()) * 20;
            }
    
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image' => asset($product->image),
                'description' => $product->description,
                'stock' => $product->stock,
                'rating' => $rating,
                'comments_count' => $comments->count(),
                'product_type' => ucfirst($product->product_type), // Añadir tipo de producto
            ];
        });
    
        return response()->json(['products' => $products]);
    }
    
    public function products()
    {
        $products = Product::paginate(5);
        
        return $products;
    }
    
    public function home()
    {
        $products = Product::latest()->get();
        $categories = Category::all();
        $user = User::latest()->get();
        $cart = Session::where('session_estatus', session_id())->get();
        $promotions = Promotion::latest()->get();
    
        return view('web/index', compact('products', 'categories', 'user', 'cart', 'promotions'));
    }
    
    public function create()
    {
        $categories = Category::all(); // Obtén todas las categorías
        $method = 'CREATE'; // Define el método como 'CREATE' en la vista de creación
        return view('admin.products.create', compact('categories', 'method'));
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Obtén todas las categorías
        $method = 'EDIT'; // Define el método como 'EDIT' en la vista de edición
        return view('admin.products.edit', compact('product', 'categories', 'method'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id', // Asegúrate de validar el category_id
            'product_type' => 'required|string|in:patente,generico', // Validar el tipo de producto
            'image' => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $fileName = FileControl::storeSingleFile($request->image, 'productsPictures');
            $request->image = "/productsPictures/{$fileName}";
        }
    
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id; // Asigna el category_id
        $product->product_type = $request->product_type; // Asigna el tipo de producto
    
        $product->save();
    
        flash('Producto añadido correctamente.')->success()->important();
    
        return redirect('admin/products');
    }
    
    public function show($id)
    {
        $product = Product::where('id', $id)->where('is_active', true)->firstOrFail();
        return view('admin.products.show', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id', // Asegúrate de validar el category_id
            'product_type' => 'required|string|in:patente,generico', // Validar el tipo de producto
            'image' => 'nullable|image|max:2048',
        ]);
    
        $product = Product::where('id', $id)->where('is_active', true)->firstOrFail();
    
        if ($request->hasFile('image')) {
            $fileName = FileControl::storeSingleFile($request->image, 'productsPictures');
            $product->image = "/productsPictures/{$fileName}";
        }
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id; // Asigna el category_id
        $product->stock = $request->stock;
        $product->product_type = $request->product_type; // Asigna el tipo de producto
    
        // Asigna otros campos si son necesarios
    
        $product->save();
    
        flash('Producto editado correctamente.')->success()->important();
    
        return redirect('admin/products');
    }
    
        

    public function destroy($id)
    {
        Product::destroy($id);

        flash('Producto eliminado correctamente.')->success()->important();

        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    
    public function inactivate($id)
    {
        $product = Product::findOrFail($id);

        // Marcar el producto como inactivo
        $product->is_active = false;
        $product->save();

        // Retornar una respuesta JSON
        return response()->json(['success' => true]);
    }

  
    public function activate($id)
    {
        $product = Product::findOrFail($id);

        // Marcar el producto como activo
        $product->is_active = true;
        $product->save();

        // Retornar una respuesta JSON
        return response()->json(['success' => true]);
    }

    public function newsLetter(Request $request, User $user)
    {
        $news = new NewsLetter();
        $news->email = $request->email;
        $news->name = $request->name;
        $news->save();

        $data = $news;
        $user->email = $data->email;
        $user->notify(new NewsLetterNotification($user, $data));

        $value = session(['key' => 'disable']);
        $products = Product::paginate(5);
        $categories = Category::all();
        $user = User::latest()->get();
        flash('Correo enviado correctamente.')->success()->important();

        // return view('web.products_list', compact('products', 'categories'));
        return back()->with(['products' => $products, 'categories' => $categories, 'user' => $user]);
    }

    public function disableModal(Request $request)
    {
        $value = session(['key' => 'disable']);
    }

    public function detailsProduct($id)
    {
        $product = Product::where('id', $id)->get()->first();

        $products = Product::latest()->get();
        $comments = Comment::where('products_id', $id)->latest()->get();

        $category = Category::where('id', $product->category_id)->get()->first();

        return view('web.product_detail', compact('product', 'products', 'comments', 'category'));
    }

    public function showAll()
    {
        // Obtener solo los productos activos paginados
        $products = Product::where('is_active', true)->paginate(30);
        
        // Obtener todas las categorías
        $categories = Category::all();
        
        // Obtener el carrito actual del usuario
        $cart = Session::where('session_estatus', session_id())->get();
    
        // Retornar la vista con los productos activos, categorías y carrito
        return view('web.products_list', compact('products', 'categories', 'cart'));
    }
    
    public function productsCategory($id)
    {
        $products = Product::where('subcategory', $id)->paginate(30);
        $categories = Category::all();
        $cart = Session::where('session_estatus', session_id())->get();

        //return compact('products', 'categories', 'cart');

        return view('web.products_list', compact('products', 'categories', 'cart'));
    }

    public function search(Request $request)
    {
        $query = trim($request->searchText);
        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(5);

        $categories = Category::all();

        return view('web.products_list', compact('products', 'categories', 'query'));
    }

    public function express_search(Request $request)
    {
        $query = $_POST['input'];

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')->get();

        $categories = Category::all();

        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

        foreach ($products as $row) {
            $output .= '<li><a href="#">' . $row->name . '</a></li>';
        }

        $output .= '</ul>';

        echo $output;

        // return $products;
        // dd($query, $products, $categories);
        // return view('web.products_list', compact('products', 'categories', 'query'));
        // return json_encode($products);
        // return response()->json($products);
    }

    public function getCategories($id)
    {
        $products = Product::where('category_id', $id)->paginate(30);
        $categories = Category::all();

        return view('web.products_list', compact('products', 'categories'));
    }

    public function checkoutView()
    {
        $cart = Session::where('session_estatus', session_id())->get();

        /* Valida si hay productos en el carrito */
        if ( !$cart->count() ) {
            return redirect('/products');
        }

        if ( Auth::guest() ) {

            return view('web.cart')->with(['cart' => $cart]);
        } else {
            $address = Adress::where('users_id', Auth::user()->id)->get()->first();
            // $user_card = DB::table('user_cards')->get()->first();
            
            return view('web.cart', compact('address', 'cart'));
        }
    }

    public function addToCart($id, $cantidad = 1)
    {
        // Ensure session is started
        if (!session_id()) {
            session_start();
        }
    
        // Find the product by ID
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->withErrors('Product not found.');
        }
    
        // Get the cart session
        $session_id = session_id();
        $Cart = Session::where('session_estatus', $session_id)->first();
    
        if ($Cart) {
            // Check if the product is already in the cart
            $cart = Session::where('session_estatus', $session_id)->where('product_id', $id)->first();
    
            if ($cart) {
                // Update the quantity of the existing product in the cart
                $cart->quantity += $cantidad;
                $cart->save();
            } else {
                // Add the new product to the cart
                Session::create([
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $cantidad,
                    "discount" => isset($product->discount) ? $product->discount : 0,
                    "price" => $product->price,
                    "img" => $product->image,
                    "category_id" => $product->category_id,
                    'session_estatus' => $session_id,
                ]);
            }
        } else {
            // Create a new cart session and add the product to it
            Session::create([
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $cantidad,
                "discount" => isset($product->discount) ? $product->discount : 0,
                "price" => $product->price,
                "img" => $product->image,
                "category_id" => $product->category_id,
                'session_estatus' => $session_id,
            ]);
        }
    
        // Recalculate discounts based on the total quantity in the cart
        $totalQuantity = Session::where('session_estatus', $session_id)->sum('quantity');
        $priceRules = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage', 'priceDiscount', 'savedTotal')->toArray();
        
        // Apply discounts based on the total quantity in the cart
        $Cart = Session::where('session_estatus', $session_id)->get();
        foreach ($Cart as $item) {
            foreach ($priceRules as $rule) {
                if ($totalQuantity >= $rule['quantityPerPackage']) {
                    $item->priceDiscount = $rule['priceDiscount'];
                    $item->discount = $rule['savedTotal'];
                } else {
                    $item->priceDiscount = 0.00;
                    $item->discount = 0.00;
                }
                $item->save();
            }
        }
    
        // Redirect to the checkout page with the updated cart
        return redirect()->route('checkout', ['cart' => Session::where('session_estatus', $session_id)->get()]);
    }
    
    public function addToCartExpress()
{
    // Inicia sesión si no está iniciada
    if (!session_id()) {
        session_start();
    }

    $sessionId = session_id();
    $searchTerm = $_GET['dato'];

    // Encuentra el producto basado en el nombre o descripción
    $product = Product::where('name', 'like', '%' . $searchTerm . '%')
        ->orWhere('description', 'like', '%' . $searchTerm . '%')
        ->first();

    // Verifica si hay un carrito existente
    $existingCart = Session::where('session_estatus', $sessionId)->first();

    if ($existingCart != null) {
        // Busca el producto en el carrito
        $cartItem = Session::where('session_estatus', $sessionId)->where('product_id', $product->id)->first();

        if ($cartItem != null) {
            // Incrementa la cantidad si el producto ya está en el carrito
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Añade un nuevo producto al carrito si no está presente
            $this->addNewItemToCart($product);
        }

        // Aplica descuentos basados en las reglas de precios
        $this->applyPriceRules($sessionId, $product->category_id);
    } else {
        // Crea un nuevo carrito y añade el producto
        $this->addNewItemToCart($product);
    }

    // Redirige al checkout con el carrito actual
    $cart = Session::where('session_estatus', $sessionId)->get();
    return redirect()->route('checkout', ['cart' => $cart]);
}

private function addNewItemToCart($product)
{
    $sessionId = session_id();
    $priceRules = PriceRules::where('category_id', $product->category_id)
        ->pluck('quantityPerPackage', 'priceDiscount', 'savedTotal')
        ->first();

    Session::create([
        "product_id" => $product->id,
        "name" => $product->name,
        "quantity" => 1,
        "discount" => $product->discount ?? 0,
        "price" => $product->price,
        "priceDiscount" => $priceRules->priceDiscount,
        'totalDiscount' => $priceRules->savedTotal,
        "img" => $product->image,
        "category_id" => $product->category_id,
        'session_estatus' => $sessionId,
    ]);
}

private function applyPriceRules($sessionId, $categoryId)
{
    $totalQuantity = Session::where('session_estatus', $sessionId)->sum('quantity');
    $priceRules = PriceRules::where('category_id', $categoryId)->orderBy('quantityPerPackage')->get();

    $applicableRule = null;
    foreach ($priceRules as $rule) {
        if ($totalQuantity >= $rule->quantityPerPackage) {
            $applicableRule = $rule;
        } else {
            break;
        }
    }

    $cartItems = Session::where('session_estatus', $sessionId)->get();
    foreach ($cartItems as $cartItem) {
        if ($applicableRule) {
            $cartItem->priceDiscount = $applicableRule->priceDiscount;
            $cartItem->discount = $applicableRule->savedTotal;
        } else {
            $cartItem->priceDiscount = 0.00;
            $cartItem->discount = 0.00;
            $cartItem->totalDiscount = 0.00;
        }
        $cartItem->save();
    }
}

    public function add()
    {
        $sessionId = session_id();
        $productId = $_GET['id'];
    
        // Valida si excede el stock
        $product = Product::find($productId);
        $stock = $product->stock;
    
        if ($stock < 1) {
            return 'exceed';
        }
    
        $cart = Session::where('session_estatus', $sessionId)->where('product_id', $productId)->first();
    
        if ($cart != null) {
            // Validate stock
            if ($stock <= $cart->quantity) {
                return 'exceed';
            }
    
            $cart->quantity++;
            $cart->save();
    
            $totalQuantity = Session::where('session_estatus', $sessionId)->sum('quantity');
            $priceRules = PriceRules::where('category_id', $cart->category_id)->pluck('quantityPerPackage', 'id')->toArray();
    
            // Verifica si hay suficientes reglas de precios para evitar errores de índice
            if (count($priceRules) < 8) {
                return 'Price rules are not properly configured';
            }
    
            $cartItems = Session::where('session_estatus', $sessionId)->get();
            
            $applicableRule = null;
            for ($i = 0; $i < count($priceRules) - 1; $i++) {
                if ($totalQuantity >= $priceRules[$i] && $totalQuantity < $priceRules[$i + 1]) {
                    $applicableRule = PriceRules::where('category_id', $cart->category_id)->where('quantityPerPackage', $priceRules[$i])->first();
                    break;
                }
            }
            
            if ($totalQuantity >= end($priceRules)) {
                $applicableRule = PriceRules::where('category_id', $cart->category_id)->where('quantityPerPackage', end($priceRules))->first();
            }
    
            foreach ($cartItems as $cartItem) {
                if ($applicableRule) {
                    $cartItem->priceDiscount = $applicableRule->priceDiscount;
                    $cartItem->discount = $applicableRule->savedTotal;
                } else {
                    $cartItem->priceDiscount = 0.00;
                    $cartItem->discount = 0.00;
                    $cartItem->totalDiscount = 0.00;
                }
                $cartItem->save();
            }
    
            return 'reload';
        }
    
        return 'yes';
    }
    
    public function rest()
    {
        $sessionId = session_id();
        $productId = $_GET['id'];
    
        $cart = Session::where('session_estatus', $sessionId)->where('product_id', $productId)->first();
    
        if ($cart != null) {
            if ($cart->quantity <= 1) {
                $cart->delete();
            } else {
                $cart->quantity--;
                $cart->save();
            }
    
            $totalQuantity = Session::where('session_estatus', $sessionId)->sum('quantity');
            $priceRules = PriceRules::where('category_id', $cart->category_id)->pluck('quantityPerPackage', 'id')->toArray();
    
            // Verifica si hay suficientes reglas de precios para evitar errores de índice
            if (count($priceRules) < 8) {
                return 'Price rules are not properly configured';
            }
    
            $cartItems = Session::where('session_estatus', $sessionId)->get();
            
            $applicableRule = null;
            for ($i = 0; $i < count($priceRules) - 1; $i++) {
                if ($totalQuantity >= $priceRules[$i] && $totalQuantity < $priceRules[$i + 1]) {
                    $applicableRule = PriceRules::where('category_id', $cart->category_id)->where('quantityPerPackage', $priceRules[$i])->first();
                    break;
                }
            }
            
            if ($totalQuantity >= end($priceRules)) {
                $applicableRule = PriceRules::where('category_id', $cart->category_id)->where('quantityPerPackage', end($priceRules))->first();
            }
    
            foreach ($cartItems as $cartItem) {
                if ($applicableRule) {
                    $cartItem->priceDiscount = $applicableRule->priceDiscount;
                    $cartItem->discount = $applicableRule->savedTotal;
                } else {
                    $cartItem->priceDiscount = 0.00;
                    $cartItem->discount = 0.00;
                    $cartItem->totalDiscount = 0.00;
                }
                $cartItem->save();
            }
    
            return 'reload';
        }
    
        return 'yes';
    }
    
    public function modifyQuantityCart()
    {
        $sessionId = session_id();
        $productId = $_GET['id'];
        $newQuantity = $_GET['quantity'];
    
        // Valida si el producto existe y obtiene el stock
        $product = Product::find($productId);
        if (!$product) {
            return 'Product not found';
        }
        
        $stock = $product->stock;
    
        // Valida si el stock es menor que 1
        if ($stock < 1) {
            return 'exceed';
        }
    
        $cart = Session::where('session_estatus', $sessionId)->where('product_id', $productId)->first();
        if ($cart != null) {
            // Valida si la cantidad solicitada excede el stock disponible
            if ($stock < $newQuantity) {
                return 'exceed';
            }
    
            $cart->quantity = $newQuantity;
            $cart->save();
    
            $totalQuantity = Session::where('session_estatus', $sessionId)->sum('quantity');
            $priceRules = PriceRules::where('category_id', $cart->category_id)->pluck('quantityPerPackage', 'id')->toArray();
    
            // Verifica si hay suficientes reglas de precios para evitar errores de índice
            if (count($priceRules) < 8) {
                return 'Price rules are not properly configured';
            }
    
            $cartItems = Session::where('session_estatus', $sessionId)->get();
            
            $applicableRule = null;
            for ($i = 0; $i < count($priceRules) - 1; $i++) {
                if ($totalQuantity >= $priceRules[$i] && $totalQuantity < $priceRules[$i + 1]) {
                    $applicableRule = PriceRules::where('category_id', $cart->category_id)->where('quantityPerPackage', $priceRules[$i])->first();
                    break;
                }
            }
            
            if ($totalQuantity >= end($priceRules)) {
                $applicableRule = PriceRules::where('category_id', $cart->category_id)->where('quantityPerPackage', end($priceRules))->first();
            }
    
            foreach ($cartItems as $cartItem) {
                if ($applicableRule) {
                    $cartItem->priceDiscount = $applicableRule->priceDiscount;
                    $cartItem->discount = $applicableRule->savedTotal;
                } else {
                    $cartItem->priceDiscount = 0.00;
                    $cartItem->discount = 0.00;
                    $cartItem->totalDiscount = 0.00;
                }
                $cartItem->save();
            }
    
            return 'reload';
        }
    
        return 'yes';
    }
    
    public function removeItemCart($id)
    {
        $sessionId = session_id();
        $cart = Session::where('session_estatus', $sessionId)->where('product_id', $id)->first();
        
        if ($cart) {
            $cart->delete();
        }
    
        $product = Product::find($id);
        
        if (!$product) {
            return back()->withErrors(['error' => 'Product not found']);
        }
    
        $totalQuantity = Session::where('session_estatus', $sessionId)->sum('quantity');
        $priceRules = PriceRules::where('category_id', $product->category_id)->pluck('quantityPerPackage', 'id')->toArray();
    
        if (count($priceRules) < 8) {
            return back()->withErrors(['error' => 'Price rules are not properly configured']);
        }
    
        $cartItems = Session::where('session_estatus', $sessionId)->get();
        
        foreach ($priceRules as $key => $value) {
            if ($totalQuantity >= $value) {
                $currentPriceRule = PriceRules::where('category_id', $product->category_id)->where('quantityPerPackage', $value)->first();
                foreach ($cartItems as $cartItem) {
                    $cartItem->priceDiscount = $currentPriceRule->priceDiscount;
                    $cartItem->discount = $currentPriceRule->savedTotal;
                    $cartItem->save();
                }
            }
        }
    
        if ($totalQuantity < $priceRules[0]) {
            foreach ($cartItems as $cartItem) {
                $cartItem->priceDiscount = 0.00;
                $cartItem->discount = 0.00;
                $cartItem->totalDiscount = 0.00;
                $cartItem->save();
            }
        }
    
        return back();
    }
    
    public function emptyCart()
    {
        $sessionId = session_id();
        $cart = Session::where('session_estatus', $sessionId)->get();
        foreach ($cart as $cartItem) {
            $cartItem->delete();
        }
    
        return back();
    }
    
    public function selectcard($id)
    {
        $address = Adress::where('users_id', Auth::user()->id)->pluck('title', 'id')->toArray();
        $user_card = DB::table('user_cards')->where('id', $id)->get()->first();
        $cart = Session::where('session_estatus', session_id())->get();
        return view('web.cart', compact('address', 'user_card', 'cart'));
    }
    public function selectPayment()
    {
        if (Auth::guest()) {
            return view('login');
        } else {
            return view('web.payment');
        }
    }
}
