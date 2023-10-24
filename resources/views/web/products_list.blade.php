@extends('web.partials.master')

@section('title', 'Productos')

@section('content')

@php
    use App\Models\Comment;
@endphp

<section class="hero-wrap d-flex parallax" style="height: 400px; background-image: url('{{ asset('backgrounds/one_bg.jpg') }}'); background-size:cover; background-position: center center; margin-top: 70px;">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        <h1 style="font-size: 50px; text-shadow: 3px 3px 3px #000; color: #fff; margin-top: 200px;" align="center">@lang('products.products')</h1>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
    	<div class="row">
       <!--      <div class="col-lg-12 mt-4 pt-2 mt-lg-0 pt-lg-0">
                <div class="sidebar">
                    <div class="widget">
                        {{-- <h5 class="widget_title">Categorias</h5> --}}
                        <ul class="product_size_switch">
                            @foreach ($categories as $category)
                            @endforeach
                            {{-- <span>xs tipo mink y seda</span> --}}
                        </ul>
                    </div>
                </div>
            </div>   -->

            </div>

            <br>
            <br>

            <div class="row">

			<div class="col-md-12">
            	<div class="row align-items-center mb-4 pb-1">
                    <div class="col-md-12">
                        <div class="product_header">

                            {!! Form::open(array('url'=>'search','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                                <div class="form-group row">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="searchText" placeholder=@lang('products.search') value={{isset($query) ? $query : ''}}>
                                        <span class="input-group-btn">
                                            <button class="btn btn-md btn-fill-out" type="submit" style="height: 100%;">@lang('products.search')</button>
                                        </span>
                                    </div>
                                </div>
                            {{Form::close()}}
                            <div class="product_header_right form-group row">
                            	<div class="products_view">
                                    <a href="javascript:Void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                    <a href="javascript:Void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row shop_container grid">
                    @foreach ($products as $product)
                        <div class="col-md-3">
                            <div class="product">
                                <!-- Stock del producto == 0 mostramos la etiqueta de AGOTADO -->
                                @if($product->stock == "0")
                                    <span class="pr_flash">AGOTADO</span>
                                @endif

                                <!-- Evento del detalle del producto -->
                                <div class="product_img" align="center">
                                    <a href="{{ url('product_detail/'.$product->id)}}">
                                        <img src="{{ asset($product->image)}}" style="width: auto !important; height: auto !important; max-width: 100%;">
                                    </a>

                                    <!-- Icon modal -->
                                    @if($product->stock != "0")
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="{{ url('add_to_cart/'.$product->id)}}" ><i class="icon-basket-loaded"></i>@lang('products.add')</a></li>
                                            {{-- <li><a href="//bestwebcreator.com/shopwise/demo/shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li> --}}
                                            {{-- <li><a href="//bestwebcreator.com/shopwise/demo/shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li> --}}
                                            {{-- <li><a href="#"><i class="icon-heart"></i></a></li> --}}
                                        </ul>
                                    </div>
                                    @endif
                                </div>

                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ url('product_detail/'.$product->id)}}">{{ $product->name}}</a></h6>
                                    <div class="product_price">
    @php
    // Inicializa el precio con el precio base del producto
    $discountedPrice = $product->price;

    // Verifica si hay un descuento en la categoría y lo aplica
    if ($product->category->percentage > 0) {
        $discountedPrice -= ($product->price * ($product->category->percentage / 100));
    }

    // Verifica si hay un descuento en el producto y lo aplica (corrige la condición)
    if ( $product->category->percentage > 0) {
        $discountedPrice -= ($product->price * ($product->discount / 100));
    }

    // Asegura que el precio no sea negativo
    $discountedPrice = max($discountedPrice, 0);

    // Formatea el precio con 2 decimales
    $formattedPrice = number_format($discountedPrice, 2);
    @endphp

    @if ($discountedPrice < $product->price)
        <span class="price">${{ $formattedPrice }} MXN</span>
        <del>${{ number_format($product->price, 2) }} MXN</del>
        <div class="on_sale">
            @if ( $product->category->percentage == 0) <!-- Corrige la condición -->
                <span>@lang('products.discount'): 0%</span>
            @else
                <span>@lang('products.discount'): {{  $product->category->percentage }}%</span>
            @endif
        </div>
    @else
        <span class="price">${{ number_format($product->price, 2) }} MXN</span>
    @endif
</div>




                                    @php
                                        $comments = Comment::where('products_id',$product->id)->get();
                                        $rating=0;
                                            if($comments->count() > 0 ){
                                                foreach ($comments as $comment) {
                                                    $rating = $rating + $comment->rating;
                                                }
                                            $rating = $rating / $comments->count();
                                            $rating = $rating * 20;
                                        }
                                    @endphp
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:{{$rating}}%"></div>
                                        </div>
                                        <span class="rating_num">{{ $comments->count()}}</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>{{ $product->description}}</p>
                                    </div>
                                    {{-- <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#87554B"></span>
                                            <span data-color="#333333"></span>
                                            <span data-color="#DA323F"></span>
                                        </div>
                                    </div> --}}

                                    
                                    @if($product->stock != "0")
                                        <div class="add-to-cart" align="center">
                                            <a href="{{ url('add_to_cart/' . $product->id) }}"
                                            class="btn btn-fill-out btn-radius"><i class="icon-basket-loaded"></i>  @lang('home.add')</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

        		<div class="row">
                    <div class="col-md-12">
                        <ul class="pagination justify-content-center pagination_style1">
                            @if ($products->currentPage() != 1)
                                <li class="page-item"><a class="page-link" href="{{$products->previousPageUrl()}}"><i class="linearicons-arrow-left"></i></a></li>
                            @endif
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                @if ($i == $products->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{$i}}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{$products->url($i)}}">{{$i}}</a></li>
                                @endif
                            @endfor
                            @if ($products->currentPage() != $products->lastPage())
                                <li class="page-item"><a class="page-link" href="{{$products->nextPageUrl()}}"><i class="linearicons-arrow-right"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
        	</div>
             </div>
    </div>
</div>

<section class="hero-wrap d-flex parallax" style="height: 400px; background-image: url('{{ asset('backgrounds/three.jpg') }}'); background-size cover; background-position: center center; margin-top: 70px;">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        
                    </div>
                </div>
            </div>
        </div><!-- END CONTAINER-->
</section>

<div class="section bg_default small_pt small_pb">
	<div class="container">
    	<div class="row align-items-center">
            <div class="col-md-4">
                <div class="heading_s1 mb-md-0 heading_light">
                    <h3>@lang('products.newsletter')</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form">
                    <form method="get" action="{{ URL('news_letter') }}">
                    <div class="form-group row">
                        <div class="col-md-10">
                        <input type="text" required="" class="form-control" placeholder="@lang('products.name')" name="name" required>
                        </div>
                    </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <input type="text" required="" class="form-control" placeholder="@lang('products.email')" name="email"  required>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-lg btn-info"  style="border-radius: 24px; width: 'auto';" name="submit" value="Submit">@lang('products.suscribe')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

@push('script')
<script>

</script>
@endpush

@endsection
