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
    public function index(Request $request)
    {
        $this->disableModal($request);
        $products = Product::latest()->get();
        $filters = Filter::latest()->get();

        foreach ($products as $product) {
            foreach ($filters as $filter) {
                if ($product->subcategory == $filter->id) {
                    $product->subcategory = $filter->name;
                }
            }
        }

        return view('admin.products.index', compact('products'));
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
        $category = Category::all()->pluck('name', 'id')->toArray();
        $subcategories = Filter::latest()->get();

        $method = 'CREATE';
        return view('admin.products.create', compact('method', 'category', 'subcategories'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $fileName = FileControl::storeSingleFile($request->image, 'productsPictures');
            $request->image = "/productsPictures/{$fileName}";
        }
        

        $products = new Product();
        $products->name = $request->name;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->image = $request->image;
        $products->category_id = $request->category_id;
        $products->subcategory = $request->subcategory;
        $products->price = $request->price;
        $products->clave_sae = $request->clave_sae;
        $products->discount = $request->discount;
        $products->stock = $request->stock;
        $products->save();

        flash('Producto añadido correctamente.')->success()->important();

        return redirect('admin/products');
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->get()->first();
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->get()->first();
        $category = Category::all()->pluck('name', 'id')->toArray();
        $subcategories = Filter::latest()->get();
        $method = 'EDIT';

        return view('admin.products.edit', compact('method', 'product', 'category', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->get()->first();
        if ($request->hasFile('image')) {
            $fileName = FileControl::storeSingleFile($request->image, 'productsPictures');
            $product->image = "/productsPictures/{$fileName}";
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        //$product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->subcategory = $request->subcategory;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->stock = $request->stock;

        //dd($product);
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
        $products = Product::paginate(30);
        $categories = Category::all();
        $cart = Session::where('session_estatus', session_id())->get();

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
        $session = session_id();
        if (!$session) {
            session_start();
        } else {

            $product = Product::find($id);
            $Cart = Session::where('session_estatus', session_id())->first();

            if ($Cart != null) {
                $cart = $Cart::where('session_estatus', session_id())->where('product_id', $id)->first();

                if ($cart != null) {
                    $cart->quantity = $cart->quantity + 1;
                    $cart->save();

                    $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');
                    $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();
                    $Cart = Session::where('session_estatus', session_id())->get();

                    // Verificar si $array tiene al menos 8 elementos
                    if (empty($array) || count($array) < 8) {
                        // Obtener los valores de $array desde la base de datos
                        $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();
                    }
                    
                    if (count($array) >= 8) {
                        if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                            // Tu lógica para el primer rango de cantidades
                        } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                            // Tu lógica para el segundo rango de cantidades
                        } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                            // Tu lógica para el tercer rango de cantidades
                        } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                            // Tu lógica para el cuarto rango de cantidades
                        } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                            // Tu lógica para el quinto rango de cantidades
                        } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                            // Tu lógica para el sexto rango de cantidades
                        } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                            // Tu lógica para el séptimo rango de cantidades
                        } elseif ($totalQuantity >= $array[7]) {
                            // Tu lógica para el octavo rango de cantidades
                        } else {
                            // Tu lógica cuando la cantidad no se encuentra en ninguno de los rangos
                        }
                    } else {
                        // Manejo de caso en el que $array no tiene al menos 8 elementos
                    }
                    

                    //print_r("Array: " . $array);
                    //print_r("priceRule: " . $priceRule);

                    //return;
                    Session::create([
                        "product_id" => $product->id,
                        "name" => $product->name,
                        "quantity" => $cantidad,
                        "discount" => isset($product->discount) ? $product->discount : 0,
                        "price" => $product->price,
                        "priceDiscount" => $priceRule->priceDiscount,
                        //"priceDiscount" => $priceRule->unitPrice,
                        'totalDiscount' => $priceRule->savedTotal,
                        "img" => $product->image,
                        "category_id" => $product->category_id,
                        'session_estatus' => session_id(),
                    ]);

                    $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');
                    $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();

                    $Cart = Session::where('session_estatus', session_id())->get();
                    if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[7]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            //$c->priceDiscount = $priceRule->unitPrice;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity < $array[0]) {
                        foreach ($Cart as $c) {
                            $c->priceDiscount = 0.00;
                            $c->discount = 0.00;
                            $c->totalDiscount = 0.00;
                            $c->save();
                        }
                    }
                    dd($cart,'ya hay carrito pero no este producto');
                }
            } else {

                // dd($product);
                $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();
                // $priceRule = PriceRules::where('category_id', $product->category_id)->first();

                //return;

                $cart = Session::create([
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $cantidad,
                    "discount" => isset($product->discount) ? $product->discount : 0,
                    "price" => $product->price,
                    // "priceDiscount" => $priceRule->priceDiscount,
                    //"priceDiscount" => $priceRule->unitPrice,
                    // 'totalDiscount' => $priceRule->savedTotal,
                    "img" => $product->image,
                    "category_id" => $product->category_id,
                    'session_estatus' => session_id(),
                ]);
            }
            $cart = Session::where('session_estatus', session_id())->get();

            /* $quantityProducts = 0;
            foreach($cart as $value) {
                $quantityProducts = $quantityProducts +  $value->quantity;
            }

            $percentageDiscount = 0;
            if ( $quantityProducts >= 24 ) {
                $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();
                $priceRule = PriceRules::where('category_id', $product->category_id)->where('quantityPerPackage', $array[1])->first();

                $percentageDiscount = $priceRule->discount;
            } */

            //return compact('cart', 'percentageDiscount');
            return redirect()->route('checkout', ['cart' => $cart, 'percentageDiscount' => 11]);
            //return redirect()->route('checkout', compact('cart', 'percentageDiscount'));
        }
    }

    public function addToCartExpress()
    {
        $session = session_id();
        if (!$session) {
            session_start();
        } else {
            $product = Product::where('name', 'like', '%' . $_GET['dato'] . '%')
                ->orWhere('description', 'like', '%' . $_GET['dato'] . '%')->first();
            $Cart = Session::where('session_estatus', session_id())->first();

            if ($Cart != null) {
                $cart = $Cart::where('session_estatus', session_id())->where('product_id', $product->id)->first();

                if ($cart != null) {
                    $cart->quantity = $cart->quantity + 1;
                    $cart->save();

                    $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');
                    $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();

                    $Cart = Session::where('session_estatus', session_id())->get();
                    if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[7]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity < $array[0]) {
                        foreach ($Cart as $c) {
                            $c->priceDiscount = 0.00;
                            $c->discount = 0.00;
                            $c->totalDiscount = 0.00;
                            $c->save();
                        }
                    }
                } else {
                    $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();
                    $priceRule = PriceRules::where('category_id', $product->category_id)->where('quantityPerPackage', $array[0])->first();

                    Session::create([
                        "product_id" => $product->id,
                        "name" => $product->name,
                        "quantity" => 1,
                        "discount" => isset($product->discount) ? $product->discount : 0,
                        "price" => $product->price,
                        "priceDiscount" => $priceRule->priceDiscount,
                        'totalDiscount' => $priceRule->savedTotal,
                        "img" => $product->image,
                        "category_id" => $product->category_id,
                        'session_estatus' => session_id(),
                    ]);

                    $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');

                    $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();

                    $Cart = Session::where('session_estatus', session_id())->get();
                    if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity >= $array[7]) {
                        foreach ($Cart as $c) {
                            $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                            $c->priceDiscount = $priceRule->priceDiscount;
                            $c->discount = $priceRule->savedTotal;
                            $c->save();
                        }
                    } elseif ($totalQuantity < $array[0]) {
                        foreach ($Cart as $c) {
                            $c->priceDiscount = 0.00;
                            $c->discount = 0.00;
                            $c->totalDiscount = 0.00;
                            $c->save();
                        }
                    }
                }
            } else {
                $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();
                $priceRule = PriceRules::where('category_id', $product->category_id)->where('quantityPerPackage', $array[0])->first();

                $cart = Session::create([
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "discount" => isset($product->discount) ? $product->discount : 0,
                    "price" => $product->price,
                    "priceDiscount" => $priceRule->priceDiscount,
                    'totalDiscount' => $priceRule->savedTotal,
                    "img" => $product->image,
                    "category_id" => $product->category_id,
                    'session_estatus' => session_id(),
                ]);
            }
            $cart = Session::where('session_estatus', session_id())->get();
        }
        return redirect()->route('checkout', ['cart' => $cart]);
        // return back();
    }
    public function add()
    {
        // Valida si excede el stock
        $product = Product::find( $_GET['id'] );
        $stock = $product->stock;

        if ( $stock < 1 ) {
            return 'exceed';
        }

        $cart = Session::where('session_estatus', session_id())->where('product_id', $_GET['id'])->first();

        if ($cart != null) {

            // Validate stock
            if ( $stock <= $cart->quantity ) {
                return 'exceed';
            }

            $cart->quantity++;
            $cart->save();

            $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');
            $array = PriceRules::where('category_id', $cart->category_id)->get()->pluck('quantityPerPackage')->toArray();

            $Cart = Session::where('session_estatus', session_id())->get();
            if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[7]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity < $array[0]) {
                // dd('simon');
                foreach ($Cart as $c) {
                    $c->priceDiscount = 0.00;
                    $c->discount = 0.00;
                    $c->totalDiscount = 0.00;
                    $c->save();
                }
                return 'reload';
            }
        }
        return 'yes';
    }
    public function rest()
    {
        $cart = Session::where('session_estatus', session_id())->where('product_id', $_GET['id'])->first();

        if ($cart != null) {
            // if (isset($cart[$_GET['id']])) {
            if ($cart->quantity <= 1) {
                $cart->delete();
                $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');

                $array = PriceRules::where('category_id', $cart->category_id)->get()->pluck('quantityPerPackage')->toArray();
                $Cart = Session::where('session_estatus', session_id())->get();

                if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[7]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity < $array[0]) {
                    // dd('simon');
                    foreach ($Cart as $c) {
                        $c->priceDiscount = 0.00;
                        $c->discount = 0.00;
                        $c->totalDiscount = 0.00;
                        $c->save();
                    }
                    return 'reload';
                }
                return 'refresh';
            } else {
                $cart->quantity--;
                $cart->save();
                $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');

                $array = PriceRules::where('category_id', $cart->category_id)->get()->pluck('quantityPerPackage')->toArray();
                $Cart = Session::where('session_estatus', session_id())->get();

                if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity >= $array[7]) {
                    foreach ($Cart as $c) {
                        $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                        $c->priceDiscount = $priceRule->priceDiscount;
                        //$c->priceDiscount = $priceRule->unitPrice;
                        $c->discount = $priceRule->savedTotal;
                        $c->save();
                    }
                    return 'reload';
                } elseif ($totalQuantity < $array[0]) {
                    // dd('simon');
                    foreach ($Cart as $c) {
                        $c->priceDiscount = 0.00;
                        $c->discount = 0.00;
                        $c->totalDiscount = 0.00;
                        $c->save();
                    }
                    return 'reload';
                }
            }
            // }
        }
        return 'yes';
    }
    public function modifyQuantityCart()
    {
        // Valida si excede el stock
        $product = Product::find( $_GET['id'] );
        $stock = $product->stock;

        if ( $stock < 1 ) {
            return 'exceed';
        }

        $cart = Session::where('session_estatus', session_id())->where('product_id', $_GET['id'])->first();
        if ($cart != null) {

            // Validate stock
            if ( $stock < $_GET['quantity'] ) {
                return 'exceed';
            }

            $cart->quantity = $_GET['quantity'];
            $cart->save();

            $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');

            $array = PriceRules::where('category_id', $cart->category_id)->get()->pluck('quantityPerPackage')->toArray();

            $Cart = Session::where('session_estatus', session_id())->get();

            if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity >= $array[7]) {
                foreach ($Cart as $c) {
                    $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                    $c->priceDiscount = $priceRule->priceDiscount;
                    //$c->priceDiscount = $priceRule->unitPrice;
                    $c->discount = $priceRule->savedTotal;
                    $c->save();
                }
                return 'reload';
            } elseif ($totalQuantity < $array[0]) {
                // dd('simon');
                foreach ($Cart as $c) {
                    $c->priceDiscount = 0.00;
                    $c->discount = 0.00;
                    $c->totalDiscount = 0.00;
                    $c->save();
                }
                return 'reload';
            }
            // }
        }
        return 'yes';
    }
    public function removeItemCart($id)
    {
        $cart = Session::where('session_estatus', session_id())->where('product_id', $id)->first();
        $cart->delete();

        $product = Product::find($id);
        $totalQuantity = Session::where('session_estatus', session_id())->get()->sum('quantity');
        $array = PriceRules::where('category_id', $product->category_id)->get()->pluck('quantityPerPackage')->toArray();
        $Cart = Session::where('session_estatus', session_id())->get();

        if ($totalQuantity >= $array[0] && $totalQuantity < $array[1]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[0])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity >= $array[1] && $totalQuantity < $array[2]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[1])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity >= $array[2] && $totalQuantity < $array[3]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[2])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity >= $array[3] && $totalQuantity < $array[4]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[3])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity >= $array[4] && $totalQuantity < $array[5]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[4])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity >= $array[5] && $totalQuantity < $array[6]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[5])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity >= $array[6] && $totalQuantity < $array[7]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[6])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity >= $array[7]) {
            foreach ($Cart as $c) {
                $priceRule = PriceRules::where('category_id', $c->category_id)->where('quantityPerPackage', $array[7])->first();
                $c->priceDiscount = $priceRule->priceDiscount;
                $c->discount = $priceRule->savedTotal;
                $c->save();
            }
        } elseif ($totalQuantity < $array[0]) {
            foreach ($Cart as $c) {
                $c->priceDiscount = 0.00;
                $c->discount = 0.00;
                $c->totalDiscount = 0.00;
                $c->save();
            }
        }
        return back();
    }
    public function emptyCart()
    {
        $cart = Session::where('session_estatus', session_id())->get();
        foreach ($cart as $c) {
            $c->delete();
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
