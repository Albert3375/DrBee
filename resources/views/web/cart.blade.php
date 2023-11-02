@extends('web.partials.master')

@section('title', 'Carrito de Compras')

@section('content')

<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        background-color: #ff9300!important;
        color: #fff!important;;
    }
    .bg-padding {
        background-color: #f7f8fb;
        padding: 0 30px;
    }
    .icons-type-card {
        display: contents;
    }
    .badge {
        white-space: unset;
    }
    .section-checkout {
        margin-top: 5em;
    }
    sup {
        color: red;
    }
    .swal2-container {
        z-index: 99999;
    }
    @media only screen and (max-width: 576px) {
        .order_review {
            padding: 0;
        }
        .bg-padding {
            padding: 0 15px;
        }
        .icons-type-card {
            display: none;
        }
        .section-checkout {
            margin-top: 90px;
        }
    }
</style>

<div class="loading" style="display: none;">Loading&#8230;</div>

<div class="main_content">
    <div class="section section-checkout">
        <div class="container-fluid" style="max-width: 1300px;">
            <div class="row">
                <div class="col-md-12 text-center">
                    @include('flash::message')
                    <div class="card text-center">
                        <div class="card-header">
                            <h2><i class="fas fa-dollar-sign"></i> @lang('cart.cart') <i class="fa fa-shopping-cart"></i></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="table-responsive shop_cart_table">
                                        <table class="table" id="reload">
                                            <thead class="text-center">
                                                <tr class="text-center">
                                                    <th class="product-thumbnail">Imagen</th>
                                                    <th class="product-name">@lang('cart.product')</th>
                                                    <th class="product-price">@lang('cart.price')</th>
                                                    <th class="product-price" style="width: 180px;">@lang('cart.price_disc')</th>
                                                    <th class="product-quantity">@lang('cart.quantity')</th>
                                                    <th class="product-subtotal">@lang('cart.total')</th>
                                               
                                                    <th class="product-quantity">@lang('cart.amount_saved')</th>
                                                    <th class="product-remove">@lang('cart.delete')</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
    @php
    $total = 0;
    $totalDiscount = 0;
    @endphp

    @if ($cart)
    @foreach ($cart as $product)
        @php
        $quantityProducts = $product->quantity;
        $discountedPrice = $product->price;
        $discountAmount = 0;

        // Verifica si hay un descuento en la categoría y lo aplica
        if ($product->category && $product->category->percentage > 0) {
            $discountedPrice -= ($product->price * ($product->category->percentage / 100));
            $discountAmount = ($product->price - $discountedPrice) * $quantityProducts;
        }

        // Asegura que el precio no sea negativo
        $discountedPrice = max($discountedPrice, 0);
        $formattedPrice = number_format($discountedPrice, 2);
        @endphp

        <tr class="text-center">
            <td class="product-thumbnail"><a href="#"><img src="{{ $product->img }}" alt="product1"></a></td>
            <td class="product-name" data-title="Producto"><a href="#">{{ $product->name }}</a></td>
            <td class="product-price" data-title="Precio">
                <span>${{ $formattedPrice }} MXN (con descuento de productos)</span>
            </td>

            <td class="product-price" data-title="Descuento">
                @if ($product->category && $product->category->percentage > 0)
                    <span>{{ $product->category->percentage }}% de descuento</span>
                @else
                    <span>Sin descuento</span>
                @endif
            </td>

            <td class="product-quantity column" data-title="Cantidad">
                <div class="quantity column" style="display: inline-block; text-align: center; border: none">
                    <input type="button" onclick="rest({{ $product->product_id }})" value="-" class="minus">
                    <input id="quantity-{{$product->product_id}}" type="number" min="1" name="quantity" value="{{ $product->quantity }}" title="Qty" class="qty" size="4" onchange="modifyCart({{$product->product_id}})">
                    <input type="button" onclick="add({{ $product->product_id }})" value="+" class="plus">
                </div>
            </td>
            <td class="product-subtotal" data-title="Total">
                <span class="" id="priceSpan-{{ $product->id }}">$ {{ number_format($discountedPrice * $quantityProducts, 2) }}</span>
            </td>
            <td class="product-quantity" data-title="Total Ahorrado">
                <span id="spanDiscount-{{$product->id}}">$ {{ number_format($discountAmount, 2) }}</span>
            </td>
            <td class="product-remove" data-title="Remove"><a href="{{ url('removeItemCart/'.$product->product_id)}}"><i class="ti-close"></i></a></td>
        </tr>
    @endforeach
    @endif
</tbody>




                                            <tfoot>
                                                <tr class="text-center">
                                                    <td colspan="12">
                                                        <div class="row no-gutters align-items-center text-center">
                                                            @if (Auth::check())
                                                            {{-- BUTTON BACK --}}
                                                            <div class="col-lg-6 col-md-6 mb-3 mt-3 mb-md-0">
                                                                <a href="javascript:history.back()"
                                                                    class="btn btn-fill-out">
                                                                    <i class="fas fa-shopping-basket"></i>
                                                                    @lang('cart.continue')
                                                                </a>
                                                            </div>
                                                            {{-- BUTTON DELETE ALL --}}
                                                            <div class="col-lg-6 col-md-6 mb-3 mt-3 mb-md-0">
                                                                <a href="{{ url('emptyCart')}}" class="btn btn-danger">
                                                                    <i class="fas fa-times"></i>
                                                                    @lang('cart.empty')
                                                                </a>
                                                            </div>
                                                            @else
                                                            {{-- BUTTON BACK --}}
                                                            <div class="col-lg-6 col-md-4 mb-3 mt-3 mb-md-0">
                                                                <a href="javascript:history.back()"
                                                                    class="btn btn-fill-out">
                                                                    <i class="fas fa-shopping-basket"></i>
                                                                    @lang('cart.continue')
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-6 col-md-4 mb-3 mt-3 mb-md-0">
                                                                <a href="{{ url('emptyCart')}}" class="btn btn-danger">
                                                                    <i class="fas fa-times"></i>
                                                                    @lang('cart.empty')
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="container">
            <div class="row">
                <!-- Comprar como invitado -->
                @if( Auth::guest() )
                    @php $mode_payment = 'guest'; @endphp
                    <div class="col-md-12">
                        <form id="formOrderGuest" method="post" action="{{ URL('storeGuest') }}">
                            @csrf
                            <input type="hidden" name="pay_method" id="pay_method">
                            <input type="hidden" name="total" id="totalFormUser" value="{{ $total }}">
                            <span class="d-none" id="totalFormSpan">{{ $total }}</span>
                            <!-- Resumen de compra y datos de envío -->
                            <div class="col-md-12" id="details">
                                <div class="order_review">
                                    <!-- Resumen de compra -->
                                    <div class="heading_s1">
                                        <h4>@lang('cart.review')</h4>
                                    </div>
                                    <div class="table-responsive order_table">
                                        <table class="table" id="reloadUserDetail">
                                            <thead>
                                                <tr>
                                                    <th> @lang('cart.product')</th>
                                                    <th> @lang('cart.total')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($cart)
                                                        @php $quantity_total = 0; @endphp
                                                        @foreach ($cart as $product)
                                                        @php
                                                            $quantity_total = $quantity_total + $product->quantity; 
                                                        @endphp
                                                        <tr>
                                                            <td class="product-name" data-title="Product"><a href="#">{{ $product->name }} x {{ $product->quantity }}</a></td>
                                                            <td class="product-subtotal" data-title="Total">
                                                                @if ($product->priceDiscount != 0)
                                                                    <span id="subtotalDetailUser-{{ $product->id }}">$ {{
                                                                    number_format($product->quantity * $product->priceDiscount, 2) }}</span>
                                                                @else
                                                                <span id="subtotalDetailUser-{{ $product->id }}">$ {{
                                                                    number_format($product->quantity * $product->price, 2) }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    <!-- Sumar cantidades de productos -->
                                                    <input type="hidden" id="product_quantity" value="{{ $quantity_total }}">
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <!-- Nuevo -->
                                                <tr>
                                                    <th> Cantidad total en piezas</th>
                                                    <td> {{$quantityProducts}} piezas </td>
                                                </tr>

                                                <!-- Viejo -->
                                                <tr>
                                                    <th> @lang('cart.delivery')</th>
                                                    <td> @lang('cart.free_delivery')</td>
                                                </tr>
                                                <tr>
                                                    <th> Descuento del mes por unidad</th>
                                                    @if ($quantityProducts >= 24)
                                                    <td> 20%</td>
                                                    @else
                                                    <td> 0%</td>
                                                    @endif
                                                    
                                                </tr>   
                                                <tr>
                                                    <th> @lang('cart.total')</th>
                                                    <td class="product-subtotal"> $
                                                        <span id="spanTotalUser">{{ number_format($total,2)}}</span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- Datos de envío -->
                                    <div class="heading_s1">
                                        <h4>@lang('cart.detail')</h4>
                                    </div>
                                    <h6><b>Zoofish no se hace responsable por envíos en donde se haya registrado una dirección incorrecta.</b></h6>
                                    <div class="col-md-12 px-0" id="adreess_shipping">
                                        <hr>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder=@lang('cart.name')>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="lname" name="lname" placeholder=@lang('cart.lastname')>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder=@lang('cart.address')>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="city" name="city" placeholder=@lang('cart.city')>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="zipcode" name="zipcode" placeholder=@lang('cart.postal')>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="phone" name="phone" placeholder=@lang('cart.phone')>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="email" name="email" placeholder=@lang('cart.email')>
                                        </div>
                                    </div>
                                    <!-- Cupón -->
                                    <div class="col-md-6 px-0 offset-md-3">
                                        <div class="heading_s1 text-center my-4">
                                            <h5> ¿Tienes un cupón de descuento? úsalo aquí: </h5><br>
                                            <input type="text" name="coupon" class="form-control" style="text-transform: uppercase;"><br>
                                            <p>* Sujeto a términos y condiciones de validez y vigencia.</p>
                                        </div>
                                    </div>
                                    <!-- Métodos de pago -->
                                    @include('web.partials.payment-methods')
                                    <!-- End métodos de pago -->
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                <!-- Comprar con sesión iniciada -->
                @if( Auth::check() )
                    @php $mode_payment = 'user'; @endphp
                    <div class="col-md-12">
                        <form id="formOrderUser" method="post" action="{{ URL('storeOrderUser') }}">
                            @csrf
                            <input type="hidden" name="address_id" id="address_id">
                            <input type="hidden" name="pay_method" id="pay_method">
                            <input type="hidden" name="total" id="totalFormUser" value="{{ $total }}">
                            <span class="d-none" id="totalFormSpan">{{ $total }}</span>
                            <!-- Resumen de compra y datos de envío -->
                            <div class="col-md-12" id="details">
                                {{-- DETAIL ORDER AS USER --}}
                                <div class="order_review">
                                    <div class="heading_s1">
                                        <h4> @lang('cart.review')</h4>
                                    </div>
                                    <div class="table-responsive order_table">
                                        <table class="table" id="reloadUserDetail">
                                            <thead>
                                                <tr>
                                                    <th> @lang('cart.product')</th>
                                                    <th> @lang('cart.total')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($cart)
                                                        @php $quantity_total = 0; @endphp
                                                        @foreach ($cart as $product)
                                                        @php
                                                            $quantity_total = $quantity_total + $product->quantity; 
                                                        @endphp
                                                        <tr>
                                                            <td class="product-name" data-title="Product"><a href="#">{{ $product->name }} x {{ $product->quantity }}</a></td>
                                                            <td class="product-subtotal" data-title="Total">
                                                                @if ($product->priceDiscount != 0)
                                                                    <span id="subtotalDetailUser-{{ $product->id }}">$ {{
                                                                    number_format($product->quantity * $product->priceDiscount, 2) }}</span>
                                                                @else
                                                                <span id="subtotalDetailUser-{{ $product->id }}">$ {{
                                                                    number_format($product->quantity * $product->price, 2) }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    <!-- Sumar cantidades de productos -->
                                                    <input type="hidden" id="product_quantity" value="{{ $quantity_total }}">
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <!-- Nuevo -->
                                                <tr>
                                                    <th> Cantidad total en piezas</th>
                                                    <td> {{$quantityProducts}} piezas </td>
                                                </tr>
                                                <tr>
                                                    <th> Descuento del mes por unidad</th>
                                                    @if ($quantityProducts >= 24)
                                                    <td> 20%</td>
                                                    @else
                                                    <td> 0%</td>
                                                    @endif
                                                    
                                                </tr> 
                                                <tr>
                                                    <th> @lang('cart.delivery')</th>
                                                    <td> @lang('cart.free_delivery')</td>
                                                </tr> 
                                                <tr>
                                                    <th> @lang('cart.total')</th>
                                                    <td class="product-subtotal"> $
                                                        <span id="spanTotalUser">{{ number_format($total,2)}}</span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="heading_s1">
                                        <h4>@lang('cart.detail')</h4>
                                    </div>
                                    <h6><b>Zoofish no se hace responsable por envíos en donde se haya registrado una dirección incorrecta.</b></h6>
                                    <div class="col-md-12 px-0 text-center">
                                        <hr>
                                        <button class="shadow-sm btn btn-fill-out mb-2" data-toggle="modal" data-target="#modalenvio">Datos de envío</button><br>
                                        <span class="badge bg-dark text-white">Seleccione el botón para registrar o modificar sus datos de envío.</span>
                                    </div>
                                    <br>
                                    <!-- Métodos de pago -->
                                    @include('web.partials.payment-methods')
                                    <!-- End métodos de pago -->
                                </div>   
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
</div>

<!-- Modal para los datos de envío -->
<div id="modalenvio" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('panel.delivery_address')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDataShipping" action="#" method="POST">
                @csrf
                <input type="hidden" name="address_id" id="address_id_modal">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 px-4 py-3">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="title">Nombre<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="title" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="street">@lang('panel.street')<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="street" name="street">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="numberExt">@lang('panel.ext')<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="numberExt" name="numberExt">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="numInt">@lang('panel.int')</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="numInt" name="numInt">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="col">@lang('panel.colony')<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="col" name="col">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="municipality">@lang('panel.municipality')<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="municipality" name="municipality">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="state">@lang('panel.state')<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="state" name="state">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="country">@lang('panel.country')<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="country" name="country">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="postalCode">@lang('panel.postal')<sup>*</sup></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="postalCode" name="postalCode">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="button-save-address" type="button" class="btn btn-fill-out">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"> </script>
<!-- <script src="https://cdn.conekta.io/js/latest/conekta.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Paypal SDK -->
<!-- <script src="https://www.paypal.com/sdk/js?currency=MXN&client-id={{ env('PAYPAL_CLIENT_ID') }}" data-namespace="paypal_sdk"></script>  -->
<!-- <script src="{{ asset('js/app.js') }}"></script> -->

<!-- Cart e idioma tablas -->
<script>
    function add(id) {

        var quantity = $('#quantity-' + id).val();

        var data = {
            'id': id,
            'quantity': quantity,
        }
        $.get('{{ url("addProduct") }}', data, function(dato) {
            if (dato == "exceed") {
                // Reset quantity
                $('#quantity-' + id).val( quantity );
                msg_warning('Ya no hay más productos en el stock');
                return false;
            } else if (dato == "yes") {
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalFormSpan').load(window.location.href +' #totalFormSpan');
            } else if(dato == "reload"){
                $('#reload').load(window.location.href + ' #reload');
                $('#reloadUserDetail').load(window.location.href + ' #reloadUserDetail');
                $('#reloadGuestDetail').load(window.location.href + ' #reloadGuestDetail');
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalFormSpan').load(window.location.href +' #totalFormSpan');
            }
        })
    }
    function rest(id) {
        var quantity = $('#quantity').val();
        var data = {
            'id': id,
            'quantity': quantity,
        }
        $.get('{{ url("restProduct")}}',data,function(dato){
            if(dato == "yes"){
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalFormSpan').load(window.location.href +' #totalFormSpan');
            } else if(dato == "refresh"){
                $('#reload').load(window.location.href + ' #reload');
            } else if(dato == "reload"){
                $('#reload').load(window.location.href + ' #reload');
                $('#reloadUserDetail').load(window.location.href + ' #reloadUserDetail');
                $('#reloadGuestDetail').load(window.location.href + ' #reloadGuestDetail');
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalFormSpan').load(window.location.href +' #totalFormSpan');
            }
        })
    }
    
    function modifyCart(id){

        var quantity = $('#quantity-' + id).val();

        var data = {
            'id': id,
            'quantity': quantity,
        }
        $.get('{{ url("modifyQuantityCart") }}', data, function(dato) {
            if (dato == "exceed") {
                // Reset quantity
                $('#quantity-' + id).val( quantity );
                msg_warning('Ya no hay más productos en el stock');
                return false;
            } else if (dato == "yes") {
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalFormSpan').load(window.location.href +' #totalFormSpan');
            } else if(dato == "reload"){
                $('#reload').load(window.location.href + ' #reload');
                $('#reloadUserDetail').load(window.location.href + ' #reloadUserDetail');
                $('#reloadGuestDetail').load(window.location.href + ' #reloadGuestDetail');
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalFormSpan').load(window.location.href +' #totalFormSpan');
            }
        })
    }

    $('#document').ready(function(){
        $('#guestInfo').show();
        $('#login').hide();
        $('#identifyForm').hide();
    })

    $('#total').on('click',function(){
        var total = $('#totalSpan').text();
        $('#Total').val(total);
        $('#identifyForm').show();
    })

    $('#clickToLogin').on('click',function(){
        $('#login').show();
        $('#guestInfo').hide();
        // $('#detailPay').hide();
    })

    $('#continueAsGuest').on('click',function(){
        $('#login').hide();
        $('#guestInfo').show();
    })

    // Idioma datatable
    @if (App::isLocale('es'))
        $('#table-cards').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "responsive": false,
            "bSort": false
        });
    @else
        $('#table-cards').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
            },
            "responsive": false,
            "bSort": false
        });
    @endif
</script>

<!-- Seleccionar tipo de método de pago-->
<script>
    $('#pay_method').val('Tarjeta');
    $('#tabsMethodPayment a[href="#nav-tab-card"]').on('click', function (e) {
        e.preventDefault()
        $('#pay_method').val('Tarjeta');
    })
    $('#tabsMethodPayment a[href="#nav-tab-cash"]').on('click', function (e) {
        e.preventDefault()
        $('#pay_method').val('Efectivo');
    })
    $('#tabsMethodPayment a[href="#nav-tab-bank"]').on('click', function (e) {
        e.preventDefault()
        $('#pay_method').val('Transferencia');
    })
    $('#tabsMethodPayment a[href="#nav-tab-paypal"]').on('click', function (e) {
        e.preventDefault()
        $('#pay_method').val('Paypal');
    })
</script>

<!-- Obtener datos de envío del usuario -->
<script>
    function setDataShipping( address ) {
        $("#address_id").val(address.id);
        $("#address_id_modal").val(address.id);
        $("#title").val(address.title);
        $("#street").val(address.street);
        $("#numberExt").val(address.numberExt);
        $("#numInt").val(address.numInt);
        $("#col").val(address.col);
        $("#municipality").val(address.municipality);
        $("#state").val(address.state);
        $("#country").val(address.country);
        $("#postalCode").val(address.postalCode);
    }
</script>

@php
    // Validamos si el usuario tiene dirección registrada para llenar los datos o registarlos
    if( isset($address) && $address ){
        $data_shipping = json_encode( $address );
        echo "<script> setDataShipping( $data_shipping ); </script>";
    }
@endphp

<!-- Guardar o modificar datos de envío -->
<script>
    $(document).ready(function() {
        $('#button-save-address').on('click', function(event) {
            event.preventDefault();
            /* Guardar datos de envío */
            if( $('#title').val() == "" || $('#street').val() == "" || $('#numberExt').val() == "" || $('#col').val() == ""
                || $('#municipality').val() == "" || $('#state').val() == "" || $('#country').val() == "" || $('#postalCode').val() == "" ) {
                msg_warning('Faltan algunos datos que son requeridos')
                return false;
            } else {
                /* if ( !ValidateCP( $('#postalCode').val() ) ) {
                    msg_warning('El Código Postal es inválido');
                    return false;
                } */
                // Loading ...
                $(".loading").css( "display", "block" );
                $.ajax({
                    type: 'POST',
                    url: "/admin/adresses",
                    data: $('#formDataShipping').serialize(),
                    success: function(response) {
                        // Exit loading ...
                        $(".loading").css( "display", "none" );
                        
                        if (response.ok) {
                            $("#address_id").val(response.address_id);
                            $("#address_id_modal").val(response.address_id);
                            Swal.fire({
                                icon: 'info',
                                title:'¡Guardado!',
                                text: response.message
                            }).then((result) => {
                                $('#modalenvio').modal('hide');
                                $('.modal-backdrop').css('display', 'none');
                            })
                        } else {
                            msg_error("Hemos tenido problemas al registar su dirección de envío")
                        }
                        
                    },
                    error:  function (response) { 
                        // Exit loading ...
                        $(".loading").css( "display", "none" );
                        msg_error('Hemos tenido un problema con el servidor, intenta más tarde por favor')
                    }
                });   
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        // Conekta.setPublicKey('{{ env('CONEKTA_PUBLIC_KEY') }}');
        // Conekta.setLanguage("es");
        // // Pay with card
        // $('#button-pay-card').on('click', function(event) {
        //     event.preventDefault();
        //     var form = '';
        //     if ( "{{ $mode_payment }}" == 'user' ) {
        //         // Validar todo OK para realizar compra
        //         if ( !validationsModeUser() ) {
        //             return false;
        //         }
        //         // Select form User
        //         form = $("#formOrderUser");
        //     }
        //     if ( "{{ $mode_payment }}" == 'guest' ) {
        //         // Validar todo OK para realizar compra
        //         if ( !validationsModeGuest() ) {
        //             return false;
        //         }
        //         // Select form Guest
        //         form = $("#formOrderGuest");
        //     }
        //     if ( form != '' ) {
        //         // Send data Conekta
        //         Conekta.Token.create(form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
        //     } else {
        //         msg_warning( 'Lo sentimos, este método de pago esta presentando algunos problemas, intente más tarde por favor' );
        //     }
        // });
        // var conektaSuccessResponseHandler = function(token) {
        //     // Enviar al input
        //     $('#token_id').val(token.id);
        //     // Store order
        //     if ( "{{ $mode_payment }}" == 'user' ) {
        //         // Send petición Ajax
        //         storeOrderUser();
        //     }
        //     if ( "{{ $mode_payment }}" == 'guest' ) {
        //         // Send petición Ajax
        //         storeOrderGuest();
        //     }
        // };
        // var conektaErrorResponseHandler = function(response) {
        //     // Exit loading ...
        //     $(".loading").css( "display", "none" );
        //     msg_error(response.message_to_purchaser)
        // };
        // Pay with cash
        $('#button-pay-cash').on('click', function(event) {
            event.preventDefault();
            if ( "{{ $mode_payment }}" == 'user' ) {
                // Validar todo OK para realizar compra
                if ( !validationsModeUser() ) {
                    return false;
                }
                // Send petición Ajax
                storeOrderUser();
            }
            if ( "{{ $mode_payment }}" == 'guest' ) {
                // Validar todo OK para realizar compra
                if ( !validationsModeGuest() ) {
                    return false;
                }
                // Send petición Ajax
                storeOrderGuest();
            }
        });
        // Pay with bank
        $('#button-pay-bank').on('click', function(event) {
            event.preventDefault();
            if ( "{{ $mode_payment }}" == 'user' ) {
                // Validar todo OK para realizar compra
                if ( !validationsModeUser() ) {
                    return false;
                }
                // Send petición Ajax
                storeOrderUser();
            }
            if ( "{{ $mode_payment }}" == 'guest' ) {
                // Validar todo OK para realizar compra
                if ( !validationsModeGuest() ) {
                    return false;
                }
                // Send petición Ajax
                storeOrderGuest();
            }
        });

        // // Pay with paypal
        // window.paypal_sdk.Buttons({
        //     locale: {
        //         country: 'MX',
        //         lang: 'es'
        //     },
        //     style: {
        //         size: 'small',
        //         color:  'blue',
        //         shape:  'pill',
        //         label:  'pay',
        //         tagline: 'false',
        //         layout: 'horizontal',
        //         size: 'responsive'
        //     },
        //     createOrder: function(data, actions) {

        //         if ( "{{ $mode_payment }}" == 'user' ) {
        //             // Validar todo OK para realizar compra
        //             if ( !validationsModeUser() ) {
        //                 return false;
        //             }
        //         }
        //         if ( "{{ $mode_payment }}" == 'guest' ) {
        //             // Validar todo OK para realizar compra
        //             if ( !validationsModeGuest() ) {
        //                 return false;
        //             }
        //         }

        //         // Get total
        //         var total = $('#totalFormSpan').text();

        //         // This function sets up the details of the transaction, including the amount and line item details.
        //         return actions.order.create({
        //             purchase_units: [{
        //                 amount: {
        //                     "currency_code": "MXN",
        //                     value: total
        //                 }
        //             }]
        //         });
                
        //     },
        //     onApprove: function(data, actions) {
        //         // This function captures the funds from the transaction.
        //         return actions.order.capture().then(function(details) {
        //             // This function shows a transaction success message to your buyer.
        //             if ( details.status == "COMPLETED" ) {

        //                 if ( "{{ $mode_payment }}" == 'user' ) {
        //                     // Send petición Ajax
        //                     storeOrderUser();
        //                 }

        //                 if ( "{{ $mode_payment }}" == 'guest' ) {
        //                     // Send petición Ajax
        //                     storeOrderGuest();
        //                 }
                        
        //             } else {
        //                 msg_error( 'No se a procesado correctamente su pago, intente nuevamente por favor.')
        //             }
                    
        //         });
        //     }
        // }).render('#paypal-button-container');
        // //This function displays Smart Payment Buttons on your web page.

    });
    function validationsModeUser() {

        if ( !$("#product_quantity").length ) {
            // El elemento NO existe
            msg_info('No ha agregado nada al carrito')
            return false;
        }
        
        if ( $("#product_quantity").val() < 1 ) {
            // Valida cantidad mayor a 1
            msg_info('El mínimo de compra es de 1 piezas')
            return false;
        }

        if ( $('#address_id').val() == '' ) {
            // El elemento NO existe
            msg_info('Aún no ha registrado ninguna dirección de envío')
            return false;
        }
        return true;
    }
    function validationsModeGuest() {

        if ( !$("#product_quantity").length ) {
            // El elemento NO existe
            msg_info('No ha agregado nada al carrito')
            return false;
        }
        
        if ( $("#product_quantity").val() < 1 ) {
            // Valida cantidad mayor a 1
            msg_info('El mínimo de compra es de 1 piezas')
            return false;
        }
        /* Validar datos de envío */
        if( $('#fname').val() == "" || $('#lname').val() == "" || $('#billing_address').val() == "" || $('#city').val() == ""
        || $('#zipcode').val() == "" || $('#phone').val() == "" || $('#email').val() == "" ) {
            msg_warning('Faltan algunos datos que son requeridos')
            return false;
        } else {
             if ( !ValidateCP( $('#zipcode').val() ) ) {
                msg_warning('El Código Postal ingresado es inválido');
                return false;
            } 
            if ( !ValidatePhone( $('#phone').val() ) ) {
                msg_warning('El teléfono ingresado es inválido (solo 10 dígitos)');
                return false;
            }
            if ( !ValidateEmail( $('#email').val() ) ) {
                msg_warning('El correo eléctrónico ingresado es inválido');
                return false;
            }
        }
        return true;
    }
    function storeOrderUser() {
        // Loading ...
        $(".loading").css( "display", "block" );
        $.ajax({
            type  : 'POST',
            url   : '/storeOrderUser',
            data  : $('#formOrderUser').serialize(),
            success: function(response) {
                // Exit loading ...
                $(".loading").css( "display", "none" );
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: response.title,
                        text: response.message
                    }).then((result) => {
                        window.location.href = '/confirmation';
                    })
                } else {
                    msg_error(response.message)
                }
            },
            error:  function (response) {
                // Exit loading ...
                $(".loading").css( "display", "none" );
                msg_error('Hemos tenido un problema con el servidor, intenta más tarde por favor')
            }
        });
    }
    function storeOrderGuest() {
        // Loading ...
        $(".loading").css( "display", "block" );
        $.ajax({
            type  : 'POST',
            url   : '/storeGuest',
            data  : $('#formOrderGuest').serialize(),
            success: function(response) {
                // Exit loading ...
                $(".loading").css( "display", "none" );
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: response.title,
                        text: response.message
                    }).then((result) => {
                        window.location.href = '/confirmation';
                    })
                } else {
                    msg_error(response.message)
                }
            },
            error:  function (response) {
                // Exit loading ...
                $(".loading").css( "display", "none" );
                msg_error('Hemos tenido un problema con el servidor, intenta más tarde por favor')
            }
        });
    }
    function ValidateEmail(mail) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
            return true;
        } else {
            return false;
        }
    }
    function ValidatePhone(phone) {
        if (/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone)){
            return true;
        } else {
            return false;
        }
    }
    function ValidateCP(cp) {
        if (/^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/.test(cp)){
            return true;
        } else {
            return false;
        }
    }
    function msg_error(mensaje) {
        Swal.fire({
            icon: 'error',
            title:'¡Error!',
            text: mensaje
        })
    }
    function msg_warning(mensaje) {
        Swal.fire({
            icon: 'warning',
            title:'¡Advertencia!',
            text: mensaje
        })
    }
    function msg_info(mensaje) {
        Swal.fire({
            icon: 'info',
            title:'Info.',
            text: mensaje
        })
    }
</script>

@endpush

@endsection