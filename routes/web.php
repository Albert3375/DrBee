<?php

use App\Http\Controllers\PerfilController;
use App\Http\Controllers\DeliveriesController;
use App\Http\Controllers\ConciliationsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsersController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/master_class', function () {
//     return view('master_class.index');
// });
Route::prefix('users')->group(function () {
    Route::get('register', 'App\Http\Controllers\Users\RegisterController@showRegistrationForm')->name('register');
    // O puedes usar un controlador diferente si lo deseas
    // Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
});



Route::get('setLanguage/{lang}','webPageController@setLanguage');

Route::get('/', 'ProductController@home');

Route::get('/admin/users/perfil', 'PerfilController@index')->name('admin.users.perfil');


// Route::resource('outlet', 'OutletController');

Route::get('product_detail/{id}','ProductController@detailsProduct')->name('product_detail');
Route::post('commets','CommentsController@store');

//Route::get('/product_detail/{id}','ProductController@detail');
Route::get('products','ProductController@showAll');
Route::get('products/{id}','ProductController@productsCategory')->name('category_products');
Route::get('search','ProductController@search');
Route::get('express_search','ProductController@express_search');
Route::get('news_letter','ProductController@newsLetter');
Route::get('disableModal','ProductController@disableModal');
Route::get('emptyCart','ProductController@emptyCart');


Route::get('add_to_cart/{id}/{cantidad?}','ProductController@addToCart');
Route::get('addToCart','ProductController@addToCartExpress');
Route::get('checkout','ProductController@checkoutView')->name('checkout');
Route::get('addProduct','ProductController@add');
Route::get('restProduct','ProductController@rest');
Route::get('modifyQuantityCart','ProductController@modifyQuantityCart');
Route::get('removeItemCart/{id}','ProductController@removeItemCart');
Route::get('getCategories/{id}',[ProductController::class,'getCategories']);
Route::get('card.select_card/{id}', 'ProductController@selectCard')->name('card.select_card');
Route::get('payment', 'ProductController@selectPayment');

Route::resource('express_purchase', 'CartController');

Route::post('storeGuest','OrdersController@storeGuest');
Route::post('storeOrderUser','OrdersController@storeOrderUser');

Route::get('/confirmation', function () {
    return view('web.confirmation');
});

Auth::routes();
Route::resource('purchase_orders', 'PurchaseOrderController');

Route::get('logout', 'Auth\LoginController@logout');
Route::post('sendInfo', 'ContactController@store');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index');
    Route::resource('users', 'UsersController');

    Route::post('deliveries/json', [DeliveriesController::class, 'json'])->name('deliveries.json');
    Route::resource('deliveries', 'DeliveriesController');

    Route::post('conciliations/json', [ConciliationsController::class, 'json'])->name('conciliations.json');
    Route::get('conciliations/download/{id}','ConciliationsController@download');
    Route::resource('conciliations', 'ConciliationsController');
    Route::resource('billing', 'BillingController');
    Route::resource('guides', 'GuidesController');
    Route::resource('purchases', 'PurchasesController');

    Route::resource('references', 'BankReferenceController');
    Route::resource('discount', 'DiscountController');

    Route::resource('bank_accounts', 'BankAccountsController');

    Route::resource('reports', 'ReportsController');

    Route::get('users_report', 'ReportsController@usersReport');

    Route::get('reports/download/{data}','ReportsController@download');

    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('comments','CommentsController');
    Route::resource('adresses','AdressesController');
    Route::resource('orders', 'PurchaseOrderController');
    
    Route::get('orders/download/{id}','PurchaseOrderController@download');

    Route::get('orders/download_order_guest/{id}','PurchaseOrderController@downloadOrderGuest');

    Route::get('orders/send/{id}','PurchaseOrderController@sendByEmail');
    Route::resource('orders_users', 'OrdersController');
    Route::get('orders_users/download/{id}','OrdersController@download');

    Route::get('orders_users/send/{id}','OrdersController@sendByEmail');
    Route::post('updateStatusOrder','OrdersController@updateStatusOrder');
    Route::post('updateStatusOrderGuest','OrdersController@updateStatusOrderGuest');
    Route::resource('estafeta', 'EstafetaController');
    Route::get('user_information/{id}','OrdersController@userInformation')->name('user_information');
    Route::get('adress_information/{id}','OrdersController@adressInformation')->name('adress_information');


    Route::get('indexRules','PriceRulesController@index');
    Route::get('editRule/{id}','PriceRulesController@edit');
    Route::post('updatePriceRule','PriceRulesController@update');

    Route::get('createguide/{id}','EstafetaController@createGuide');

    Route::resource('payments', 'CardController');

    Route::resource('reporter', 'ReporterController');
    Route::get('reporterPurchases', 'ReporterController@purchases');
    Route::get('reporterClientPurchases', 'ReporterController@clientPurchases');
    Route::get('reporterDaySales', 'ReporterController@daySales');
    Route::get('reporterCloseDay', 'ReporterController@closeDay');
    Route::get('reporterMonthSales', 'ReporterController@monthSales');
    Route::get('reporterFilterSales', 'ReporterController@filterSales');
    Route::get('getProductGuest','WarehouseController@getProductGuest');
    Route::get('getProductUser','WarehouseController@getProductUser');
    Route::resource('warehouse', 'WarehouseController');
    Route::get('warehouse_control', 'WarehouseController@warehouseControl');
    Route::get('warehouse_pendings', 'WarehouseController@warehousePendings');
    Route::get('warehouse_history', 'WarehouseController@warehouseHistory');
    Route::post('confirmationWarehouse','WarehouseController@confirmationWarehouse');
    Route::post('reportarWarehouse','WarehouseController@reportarWarehouse');

    Route::resource('filters', 'FilterController');

    Route::resource('promotions', 'PromotionController');

    Route::resource('coupons', 'CouponController');

    //payment form
    Route::get('/paypal', 'PaymentController@index');

    // route for processing payment
    Route::post('paypal', 'PaymentController@payWithpaypal');

});

Route::post('paypal', 'PaymentController@payWithpaypal');

Route::get('status', 'PaymentController@getPaymentStatus');

// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');

Route::post('get_best_seller_products/', 'ReportsController@getBestSellerProducts');

Route::get('/contacto', 'App\Http\Controllers\ContactController@mostrarFormulario');
Route::post('/contacto', 'App\Http\Controllers\ContactController@enviarMensaje');

Route::get('/tags', 'TagController@index');
// routes/web.php
// En routes/web.php

Route::post('/admin/products/inactivate/{id}', [ProductController::class, 'inactivate'])->name('admin.products.inactivate');
Route::post('/admin/products/activate/{id}', [ProductController::class, 'activate'])->name('admin.products.activate');

// En routes/web.php o routes/api.php
Route::post('/cart/add', [OrdersController::class, 'addToCart'])->name('cart.add');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

//Cards
 Route::post('addPaymentMethod','ConektaController@addPaymentMethod');
 Route::post('addCard','ConektaController@addCard');
 Route::delete('destroyCard','ConektaController@destroyCard')->name('admin.payments.destroy');
 Route::get('getCardsByUser/{id}','ConektaController@getCardsByUser');
 Route::post('addCustomer','ConektaController@addCustomer');

 Route::post('/payWithConekta','ConektaController@payWithConekta');

 // web.php

Route::get('/api/products', 'ProductController@getProductsByCategory');

Route::post('/contact', [ContactController::class, 'sendContactForm'])->name('contact.send');