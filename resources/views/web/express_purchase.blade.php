@extends('web.partials.master')

@section('title', 'Compra Express')

@section('content')
<!-- START SECTION SHOP -->
<div class="section" style="margin-top: 20px;">
    <div class="container" style="max-width: 1300px;">
        <div class="row">
        	<div class="col-md-12" align="center">
        		<div class="card">
        			<div class="card-header">
        				<h2><i class="fa fa-shopping-cart"></i> @lang('cart.express') <i class="fa fa-bolt"></i></h2>
        			</div>
        			<div class="card-body">
        				<div class="row">
        					<div class="col-md-12" align="center">
        						<div class="table-responsive">
			                    	<table class="table" id="credits_table">
			                    		<thead>
			                           		<tr align="center">
			                           			<th>
			                           				<h4 class="mb-md-0 mb-3">@lang('cart.search')</h4>
			                           			</th>
			                           			{{-- <th>
			                           				Cantidad
			                           			</th>
			                           			<th>Precio</th> --}}
			                           			<div id="result"></div>
					                        </tr>
					                    </thead>
					                    <tbody>
					                    	<tr align="center">
					                    		<td>
					                    			<div class="mt-3 mb-md-0 mb-3">
				                           				{{-- {!! Form::open(['url'=>'']) !!} --}}
							                                <div class="form-group">
							                                    <div class="input-group">
                                                                    <div class="form-group col-md-9" id="nose">
                                                                        <input  type="text" id="search-box" class="form-control" placeholder=@lang('cart.example') name="searchText" />
                                                                        <div id="suggesstion-box"></div>
                                                                    </div>
							                                        {{-- <input  value="{{isset($query) ? $query : ''}}"> --}}

							                                        <span class="input-group-btn">
							                                            <button onclick="addToCart()"
                                                                            class="btn btn-fill-out"><i class="icon-basket-loaded"></i> @lang('home.add')</button>
							                                        </span>
							                                    </div>
							                                </div>
                                                            {{-- <div class="form-group">
                                                                <input type="text" id="search-box" class="form-control" placeholder=@lang('cart.example') name="search-box"/>
                                                                <div id="suggesstion-box"></div>
                                                            </div> --}}
							                            {{-- {{Form::close()}} --}}
							                        </div>
			                           			</td>
			                           			{{-- <td>
			                           				<div class="quantity column" align="center" style="text-align: center; margin-top: 5px; border: none;">
		                                                <input type="button" onclick="rest(1)" value="-"
		                                                    class="minus">
		                                                <input id="quantity" type="text" disabled name="quantity"
		                                                    value="1" title="Qty" class="qty" size="4">
		                                                <input type="button" onclick="add(1)" value="+"
		                                                    class="plus">
		                                            </div>
			                           			</td>
			                           			<td>0</td> --}}
					                    	</tr>
					                    </tbody>
					                   	<tfoot>
					                   		<tr align="center">
					                   			<th>
					                   				<h5 class="mt-3 mb-md-0 mb-3">
					                   					<i style="color:red;" class="fas fa-exclamation-triangle"></i> @lang('cart.minimum')
					                   				</h5>
					                   			</th>
					                   		</tr>
					                   	</tfoot>
					                </table>
					            </div>
        					</div>
        				</div>

        				<div class="col-md-12">
        					<div class="table-responsive shop_cart_table">
			                    <table class="table" id="reload">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">@lang('cart.product')</th>
                                            <th class="product-price" >@lang('cart.price')</th>
                                            <th class="product-price" style="width: 120px;">@lang('cart.price_disc')</th>
                                            <th class="product-quantity">@lang('cart.quantity')</th>
                                            <th class="product-subtotal">@lang('cart.total')</th>
                                            <th class="product-subtotal">@lang('cart.total_disc')</th>
                                            <th class="product-quantity">@lang('cart.amount_saved')</th>
                                            <th class="product-remove">@lang('cart.delete')</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @php
                                            $total = 0;
                                        @endphp
                                        @if ($cart)
                                            @foreach ($cart as $product)
                                                @php
                                                    if($product->priceDiscount != 0){
                                                        $subtotal = $product->quantity * $product->priceDiscount;
                                                    }else{
                                                        $subtotal = $product->quantity * $product->price;
                                                    }
                                                    $subTotal = $product->quantity * $product->price;
                                                    $subtotalDiscount = $product->quantity* $product->priceDiscount;
                                                    $total = $subtotal + $total;
                                                @endphp
                                                <tr >
                                                    <td class="product-thumbnail"><a href="#"><img src="{{ $product->img }}"
                                                                alt="product1"></a></td>
                                                    <td class="product-name" data-title="Producto"><a
                                                            href="#">{{ $product->name }}</a></td>
                                                    <td class="product-price"  data-title="Precio">$ {{ $product->price }}</td>
                                                    <td class="product-price" data-title="Precio con Desc." >
                                                        <span id="priceDiscountSpan-{{$product->id}}">$ {{ number_format($product->priceDiscount,2) }}</span>
                                                    </td>
                                                    <td class="product-quantity column" data-title="Cantidad">
                                                        <div class="quantity column"
                                                            style="display: inline-block; text-align: center; border: none">
                                                            <input type="button" onclick="rest({{ $product->product_id }})" value="-"
                                                                class="minus">
                                                            <input id="quantity-{{$product->product_id}}" type="text" min="1" name="quantity"
                                                                value="{{ $product->quantity }}" title="Qty" class="qty" size="4" onchange="modifyCart({{$product->product_id}})">
                                                            <input type="button" onclick="add({{ $product->product_id }})" value="+"
                                                                class="plus">
                                                        </div>
                                                    </td >
                                                    <td class="product-subtotal"  data-title="Total">
                                                        <span class="" id="priceSpan-{{ $product->id }}">$ {{ number_format($subTotal, 2) }}</span>
                                                    </td>
                                                    <td class="product-subtotal" data-title="Total con Desc.">
                                                        <span id="priceSpanDisc-{{ $product->id }}">$ {{ number_format($subtotalDiscount, 2) }}</span>
                                                    </td>
                                                    <td class="product-quantity" data-title="Total Ahorrado">
                                                        <span id="spanDiscount-{{$product->id}}">$ {{ number_format($product->totalDiscount,2)}}</span>
                                                    </td>
                                                    <td class="product-remove" data-title="Remove"><a href="{{ url('removeItemCart/'.$product->product_id)}}"><i
                                                        class="ti-close"></i></a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr align="center">
                                            <td colspan="12">
                                                <div class="row no-gutters align-items-center" align="center">
                                                    {{-- BUTTON BACK --}}
                                                    <div class="col-lg-4 col-md-4 mb-3 mt-3 mb-md-0">
                                                        <a href="javascript:history.back()" class="btn btn-fill-out">
                                                            <i class="fas fa-shopping-basket"></i>
                                                            @lang('cart.continue')
                                                        </a>
                                                    </div>
                                                    {{-- BUTTON DELETE ALL --}}
                                                    <div class="col-lg-4 col-md-4 mb-3 mt-3 mb-md-0">
                                                        <a href="{{ url('emptyCart')}}" class="btn btn-danger">
                                                            <i class="fas fa-times"></i>
                                                            @lang('cart.empty')
                                                        </a>
                                                    </div>
                                                    {{-- PROCEED TO PAY BUTTON --}}
                                                    <div class="col-lg-4 col-md-4 mb-3 mt-3 mb-md-0">
                                                        <button class="btn btn-line-fill" id="total" type="button">
                                                            <i class="fas fa-dollar-sign"></i>
                                                            @lang('cart.pay')
                                                        </button>
                                                    </div>
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
           {{-- detalle de pago --}}
           <div id="details">
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            {{-- vista alguien NO LOGUEADO --}}
            @if(Auth::guest())
                <div class="row" id="identifyForm">
                    {{-- login --}}
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fas fa-user"></i>@lang('cart.already') <a id="clickToLogin" data-toggle="collapse" class="collapsed" href="" >
                                @lang('cart.login')
                            </a></span>
                        </div>
                    </div>
                    {{--abrir guest form --}}
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fas fa-tag"></i><a href="#coupon" id="continueAsGuest" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                @lang('cart.guest')
                            </a></span>
                        </div>
                    </div>
                </div>
            {{-- vista de alguien LOGUEADO --}}
            @else
                {!! Form::open(['url'=>'storeOrderUser']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @if (empty($address))
                                    @php $enablePurchase = false;
                                    @endphp
                                @else
                                    @php $enablePurchase = true;
                                    @endphp
                                @endif
                            </div>
                        </div>
                        {{-- DETAIL ORDER AS USER --}}
                        <div class="col-md-6" >
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
                                                    @foreach ($cart as $product)
                                                        <tr>
                                                            <td class="product-name" data-title="Product"><a href="#">{{ $product->name }}</a></td>
                                                            <td class="product-subtotal" data-title="Total">
                                                                @if ($product->priceDiscount != 0)
                                                                    <span id="subtotalDetailUser-{{ $product->id }}">$ {{ number_format($product->quantity * $product->priceDiscount, 2) }}</span>
                                                                @else
                                                                    <span id="subtotalDetailUser-{{ $product->id }}">$ {{ number_format($product->quantity * $product->price, 2) }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th> @lang('cart.delivery')</th>
                                                <td> @lang('cart.free_delivery')</td>
                                            </tr>
                                            <tr>
                                                <th> @lang('cart.total')</th>
                                                <td  class="product-subtotal"> $
                                                    <span id="spanTotalUser">{{ number_format($total,2)}}</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment_method">
                                    <div class="heading_s1">
                                        <h4> @lang('cart.payment')</h4>
                                    </div>
                                    <div class="payment_option">
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio" name="payment_option" id="radio1" value="Tarjeta" checked="">
                                            <label class="form-check-label" for="radio1"> @lang('cart.card')</label>
                                            <p data-method="Tarjeta" class="payment-text">
                                                @if(isset($user_card)==false)
                                                <a href="{{ url('payment')}}" class="btn btn-success" style="color:#fff;">
                                                    <i class="fa fa-credit-card"></i>
                                                        @lang('cart.choose_card')
                                                </a>
                                                @else
                                                    @lang('cart.termination')
                                                    <input type="hidden" name="card_id" value="{{ $user_card->id }}">
                                                    {{ $user_card->last4 }}
                                                    @if ($user_card->brand == 'visa')
                                                        <i class="fa fa-cc-visa"></i> Visa
                                                    @elseif($user_card->brand == 'mastercard')
                                                        <i class="fa fa-cc-mastercard"></i> Mastercard
                                                    @endif
                                                <input type="hidden" name="conekta_token_id" value="{{ $user_card->conekta_token_id }}">
                                                <input type="hidden" name="source_index" value="{{ $user_card->source_index }}">
                                                <a href="{{ url('payment')}}" class="btn btn-success" style="color:#fff;">
                                                    <i class="fa fa-credit-card"></i>
                                                        @lang('cart.change_card')
                                                </a>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" type="radio" name="payment_option" id="radio2" value="Efectivo">
                                            <label class="form-check-label" for="radio2">
                                                @lang('cart.cash')
                                            </label>
                                            <p data-method="Efectivo" class="payment-text">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                        </div>
                                        {{--<div class="custome-radio">
                                            <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios5" value="option5">
                                            <label class="form-check-label" for="exampleRadios5">Paypal</label>
                                            <p data-method="option5" class="payment-text">Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.</p>
                                        </div>--}}
                                    </div>
                                </div>
                                {!! Form::hidden('user', Auth::user()->id,['id'=>"user"]) !!}
                                {!! Form::hidden('payment_method', '',['id'=>'payment_method']) !!}
                                {!! Form::hidden('total', $total, ['id'=>'totalFormUser']) !!}
                                <h6><b>Zoofish no se hace responsable por envíos en donde se haya registrado una dirección incorrecta. </b></h6>
                                @if(isset($enablePurchase) == false)
                                    <button type="submit" class="btn btn-fill-out btn-block">@lang('cart.finish')</button>
                                @elseif($enablePurchase)
                                    <div class="form-group">
                                        {!! Form::label('Address', 'Delivery Address') !!}
                                        {!! Form::select('Address', $address,0, ['class'=>'form-control']) !!}
                                    </div>
                                    <h6><b>Zoofish no se hace responsable por envíos en donde se haya registrado una dirección incorrecta. </b></h6>
                                    <button type="submit" class="btn btn-fill-out btn-block">@lang('cart.finish')</button>
                                @else
                                    {{-- <p>@lang('cart.choose_address')</p> --}}
                                    @if (empty($address))
                                        <a href="{{ url('admin/adresses')}}" type="button" class="btn btn-link">
                                            @lang('cart.add_address')
                                        </a>

                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endif
        </div>
        {{-- SECTION LOGIN --}}
        <div class="row" id="login" style="margin-top: 40px">
            <div class="login_form col-md-6" id="loginForm">
                <div class="panel-collapse login_form " >
                    <div class="panel-body">
                        <p>
                            @lang('cart.enter_data')
                        </p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" required="" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" class="form-control @error('password') is-invalid @enderror"  type="password"  required autocomplete="current-password" name="password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="login_footer form-group">
                                <div class="chek-form">
                                    {{-- <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                        <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                    </div> --}}
                                </div>
                                <a href="{{ route('password.request')}}">
                                    @lang('login.forgot')
                                </a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">
                                    @lang('login.login')
                                </button>
                            </div>
                        </form>
                        <div class="form-note text-center">@lang('login.no_account') <a href="{{ url('register')}}">@lang('login.register_now')</a></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- vista de detalle de un invitado --}}
        <form method="post" action="{{ URL('storeGuest') }}">
            <div class="row" id="guestInfo" style="margin-top: 40px">
                {{-- datos de envío --}}
                <div class="col-md-6">
                    <div class="heading_s1">
                        <h4>@lang('cart.detail')</h4>
                    </div>
                        @csrf
                        <div class="form-group">
                            <input type="text" required class="form-control" name="fname" id="fname" placeholder=@lang('cart.name')>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" name="lname" id="lname" placeholder=@lang('cart.lastname')>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="billing_address" required="" id="billing_address"
                                placeholder=@lang('cart.address')>
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" id="city" name="city" placeholder=@lang('cart.city')*>
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" id="zipcode" name="zipcode" placeholder=@lang('cart.postal')>
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" id="phone" name="phone" placeholder=@lang('cart.phone')>
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" id="email" name="email" placeholder=@lang('cart.email')>
                        </div>
                </div>
                {{-- detalle de la compra --}}
                <div class="col-md-6" >
                    <div class="order_review">
                        <div class="heading_s1">
                            <h4>@lang('cart.review')</h4>
                        </div>
                        <div class="table-responsive order_table">
                            <table class="table" id="reloadGuestDetail">
                                <thead>
                                    <tr>
                                        <th>@lang('cart.product')</th>
                                        <th>@lang('cart.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if ($cart)
                                            @foreach ($cart as $product)
                                                <tr>
                                                    <td class="product-name" data-title="Product"><a href="#">{{ $product->name}}</a></td>
                                                    <td class="product-subtotal" data-title="Total">
                                                        @if ($product->priceDiscount != 0)
                                                            <span id="subtotalDetail-{{ $product->id }}">$ {{ number_format($product->quantity * $product->priceDiscount, 2) }}</span>
                                                        @else
                                                            <span id="subtotalDetail-{{ $product->id }}">$ {{ number_format($product->quantity * $product->price, 2) }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tr>
                                </tbody>
                                    <tr>
                                        <th>@lang('cart.delivery')</th>
                                        <td>@lang('cart.free_delivery')</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('cart.total')</th>
                                        <td class="product-subtotal"> $
                                            <span id="spanTotal">{{ number_format($total,2)}}</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                            <div class="heading_s1">
                                <h4>@lang('cart.payment')</h4>
                            </div>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" value="Efectivo" checked="">
                                    <label class="form-check-label" for="exampleRadios3">@lang('cart.cash')</label>
                                    <p data-method="Efectivo" class="payment-text">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode</p>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios4" value="Tarjeta">
                                    <label class="form-check-label" for="exampleRadios4">@lang('cart.card')</label>
                                    <p data-method="Tarjeta" class="payment-text">@lang('cart.must')</p>
                                </div>
                            </div>
                        </div>
                        {!! Form::hidden('total', $total, ['id'=>'totalFormUser']) !!}
                        {!! Form::hidden('payment_method', '',['id'=>'payment_method']) !!}
                        <h6><b>Zoofish no se hace responsable por envíos en donde se haya registrado una dirección incorrecta. </b></h6>
                        <button id="button_submit" type="submit" class="btn btn-fill-out btn-block">@lang('cart.finish')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END SECTION SHOP -->

@endsection
@push('script')
<script>
     function add(id) {
        var quantity = $('#quantity').val();
        var data = {
            'id': id,
            'quantity': quantity,
        }
        $.get('{{ url("addProduct") }}', data, function(dato) {
            // alert(dato)
            if (dato == "yes") {
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalForm').load(window.location.href +' #totalForm');
            }else if(dato == "reload"){
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
                $('#totalForm').load(window.location.href +' #totalForm');
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
                    $('#totalForm').load(window.location.href +' #totalForm');
                }else if(dato == "refresh"){
                    $('#reload').load(window.location.href + ' #reload');
                }else if(dato == "reload"){
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
                    $('#totalForm').load(window.location.href +' #totalForm');
                }
            })
    }
    $('#document').ready(function(){
        $('#guestInfo').hide();
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
    $('#payment_method').on('change',function(){
        if($('#payment_method').val() == 'Tarjeta'){
            $('#button_submit').hide();
        }
        else{
            $('#button_submit').show();
        }
    })
    // AJAX call for autocomplete
	$(document).ready(function(){
		$("#search-box").keyup(function(){

            var data = {
                'input' : $(this).val(),
                '_token' : '{{ csrf_token() }}'
            }

            $.post('{{ url("api/express_search")}}',data,function(dato){
                $('#suggesstion-box').fadeIn();
                $('#suggesstion-box').html(dato);

            })
        });
        $(document).on('click', 'li', function(){
            // alert($(this).text())
            $('#search-box').val($(this).text());
            $('#suggesstion-box').fadeOut();
        })


	});
    function addToCart(){
        // alert($('#search-box').val())
        var dato = {
            'dato' : $('#search-box').val(),
        }
       $.get('{{ url("addToCart")}}',dato, function(data){
            // alert(data)
            location.reload();
       })
    }
    function modifyCart(id){
        var quantity = $('#quantity-'+id).val();
        // alert(id)
        var data = {
            'id': id,
            'quantity': quantity,
        }

        $.get('{{ url("modifyQuantityCart") }}', data, function(dato) {
            if (dato == "yes") {
                $('#priceSpan-'+id ).load(window.location.href + ' #priceSpan-'+id);
                $('#priceSpanDisc-'+id ).load(window.location.href + ' #priceSpanDisc-'+id);
                $('#priceDiscountSpan-'+id ).load(window.location.href + ' #priceDiscountSpan-'+id);
                $('#spanDiscount-'+id ).load(window.location.href + ' #spanDiscount-'+id);
                $('#spanTotal').load(window.location.href +' #spanTotal');
                $('#subtotalDetail-' + id).load(window.location.href +' #subtotalDetail-' + id);
                $('#spanTotalUser').load(window.location.href +' #spanTotalUser');
                $('#subtotalDetailUser-' + id).load(window.location.href +' #subtotalDetailUser-' + id);
                $('#totalFormUser').load(window.location.href +' #totalFormUser');
                $('#totalForm').load(window.location.href +' #totalForm');
            }else if(dato == "reload"){
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
                $('#totalForm').load(window.location.href +' #totalForm');
            }
        })
    }
</script>
@endpush
