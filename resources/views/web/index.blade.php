@php
    use App\Models\Comment;
@endphp
@extends('web.partials.master')

@section('title', 'Inicio')

@section('popup')
    @if(session('key') == null)
        @include('web.partials.newsletter_modal')
    @endif
@endsection

@section('content')

<!-- START SECTION BANNER -->
<div class="banner_section full_screen staggered-animation-wrap">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow carousel_style2"
        data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active background_bg overlay_bg_50" data-img-src="backgrounds/one_bg.jpg">
                <div class="banner_slide_content banner_content_inner">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10">
                                <div class="banner_content text_white text-center">
                                    {{-- <h5 class="mb-3 bg_strip staggered-animation text-uppercase"
                                        data-animation="fadeInDown" data-animation-delay="0.2s">@lang('home.prices')</h5>
                                    <h2 class="staggered-animation" data-animation="fadeInDown"
                                        data-animation-delay="0.3s">
                                        <img src="images/logo.png" alt="logo" style="width: auto !important; height: auto !important; max-width: 80%;">
                                    </h2>
                                    <h4 class="staggered-animation" data-animation="fadeInUp"
                                        data-animation-delay="0.4s">@lang('home.glamour')</h4>
                                        <br>
                                    <a class="btn btn-white staggered-animation" href="{{ url('/products')}}"
                                        data-animation="fadeInUp" data-animation-delay="0.5s">@lang('home.products')</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="carousel-item background_bg overlay_bg_50" data-img-src="assets/images/banner11.jpg">
                <div class="banner_slide_content banner_content_inner">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10">
                                <div class="banner_content text_white text-center">
                                    <h5 class="mb-3 staggered-animation font-weight-light" data-animation="fadeInDown"
                                        data-animation-delay="0.2s">Get up to 50% off Today Only!</h5>
                                    <h2 class="staggered-animation" data-animation="fadeInDown"
                                        data-animation-delay="0.3s">Quality Furniture</h2>
                                    <p class="staggered-animation" data-animation="fadeInUp"
                                        data-animation-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    <a class="btn btn-white staggered-animation" href="shop-left-sidebar.html"
                                        data-animation="fadeInUp" data-animation-delay="0.4s">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="carousel-item background_bg overlay_bg_60" data-img-src="assets/images/banner12.jpg">
                <div class="banner_slide_content banner_content_inner">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10">
                                <div class="banner_content text_white text-center">
                                    <h5 class="mb-3 staggered-animation font-weight-light" data-animation="fadeInDown"
                                        data-animation-delay="0.2s">Taking your Viewing Experience to Next Level</h5>
                                    <h2 class="staggered-animation" data-animation="fadeInDown"
                                        data-animation-delay="0.3s">Living Room Collection</h2>
                                    <p class="staggered-animation" data-animation="fadeInUp"
                                        data-animation-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    <a class="btn btn-white staggered-animation" href="shop-left-sidebar.html"
                                        data-animation="fadeInUp" data-animation-delay="0.4s">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i
                class="ion-chevron-left"></i></a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i
                class="ion-chevron-right"></i></a> --}}
    </div>
</div>
<!-- END SECTION BANNER -->

<!-- END MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION CATEGORIES -->
   {{--  <div class="section pt-0 small_pb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cat_overlap radius_all_5">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-4" align="center">
                                <div class="text-center text-md-left">
                                    <h4>@lang('home.categories')</h4>
                                    <p class="mb-2">@lang('home.find')</p>
                                    <a href="{{ url('/products')}}" class="btn btn-line-fill btn-sm">Ver productos</a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5"
                                    data-loop="true" data-dots="false" data-nav="false" data-margin="30"
                                    data-responsive='{"0":{"items": "1"}, "380":{"items": "2"}}'>
                                    @foreach ($categories as $category)
                                        <div class="item">
                                            <div class="categories_box">
                                                <a href="{{ url('/products')}}">
                                                    <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjE1Ny41ODdweCIgaGVpZ2h0PSIxNTcuNTg3cHgiIHZpZXdCb3g9IjAgMCAxNTcuNTg3IDE1Ny41ODciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE1Ny41ODcgMTU3LjU4NzsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPHBhdGggZD0iTTU1Ljc4OCw5NS44MzNjMCwxMi42ODksMTAuMzE0LDIyLjk5OSwyMi45OTIsMjIuOTk5YzEyLjY5LDAsMjIuOTk0LTEwLjMxLDIyLjk5NC0yMi45OTkNCgkJYzAtMTIuNjktMTAuMzE0LTIyLjk5Ni0yMi45OTQtMjIuOTk2QzY2LjEwMiw3Mi44NDQsNTUuNzg4LDgzLjE0Myw1NS43ODgsOTUuODMzeiBNNzguNzgsNzguNDQ5DQoJCWM5LjU5NCwwLDE3LjM5MSw3LjgwMywxNy4zOTEsMTcuMzljMCw5LjU5My03LjgwNywxNy4zOTEtMTcuMzkxLDE3LjM5MWMtOS41ODMsMC0xNy4zODktNy44MS0xNy4zODktMTcuMzkxDQoJCUM2MS4zOTEsODYuMjQ3LDY5LjE5Miw3OC40NDksNzguNzgsNzguNDQ5eiBNNzUuOTc3LDEwNy41MDVjMC0xLjU0MSwxLjI1NS0yLjgwMiwyLjgwMy0yLjgwMmM0Ljg4NSwwLDguODYtMy45NzksOC44Ni04Ljg3DQoJCWMwLTEuNTM3LDEuMjY1LTIuODAyLDIuODAyLTIuODAyYzEuNTUsMCwyLjgwMiwxLjI2NSwyLjgwMiwyLjgwMmMwLDcuOTc5LTYuNDksMTQuNDc0LTE0LjQ2NCwxNC40NzQNCgkJQzc3LjIzMiwxMTAuMzA3LDc1Ljk3NywxMDkuMDQ3LDc1Ljk3NywxMDcuNTA1eiBNNzguNzcyLDY1LjAxNmMtMzMuMzEzLDAtNTkuNzU0LDI3LjcxNS02MC44NjMsMjguODk3DQoJCWMtMS4wMTMsMS4wNzQtMS4wMTMsMi43NiwwLDMuODQyYzEuMTA5LDEuMTc2LDI3LjU1LDI4LjkwMyw2MC44NjMsMjguOTAzYzMzLjMyNCwwLDU5Ljc3MS0yNy43MjgsNjAuODc5LTI4LjkwMw0KCQljMS4wMTMtMS4wNzIsMS4wMTMtMi43NTgsMC0zLjg0MkMxMzguNTQyLDkyLjczMSwxMTIuMDk2LDY1LjAxNiw3OC43NzIsNjUuMDE2eiBNNzguNzcyLDEyMS4wNTQNCgkJYy0yNS45NzIsMC00OC4yNjEtMTkuMDMxLTU0LjgyOC0yNS4yMjFjNi41NjctNi4xODgsMjguODU2LTI1LjIxNSw1NC44MjgtMjUuMjE1YzI1Ljk3NiwwLDQ4LjI3MSwxOS4wMjYsNTQuODQ2LDI1LjIxNQ0KCQlDMTI3LjA0MywxMDIuMDIzLDEwNC43NDgsMTIxLjA1NCw3OC43NzIsMTIxLjA1NHogTTE1Ni43NjIsNjYuNTM0bC0xMC44MTIsMTAuODFjMy43NjcsMi45NjYsNS44NzcsNC45OCw1Ljk1Myw1LjA1Nw0KCQljMS4wNTksMS4xMjEsMS4wMTMsMi45MDUtMC4xMTgsMy45NjJjLTAuNTQyLDAuNTAzLTEuMjMzLDAuNzU0LTEuOTIzLDAuNzU0Yy0wLjc0OSwwLTEuNDk0LTAuMjk1LTIuMDQxLTAuODY5DQoJCWMtMC4yNzktMC4zMDItMzAuNDM4LTI5LjE2Ni02OS40OTYtMjkuMTY2Yy0zOC42MTgsMC02OC4yOTMsMjguODY0LTY4LjU2OCwyOS4xNjFjLTEuMDUzLDEuMTE2LTIuODI1LDEuMTg3LTMuOTYxLDAuMTINCgkJYy0xLjEyNi0xLjA1Ny0xLjE4OS0yLjgyNC0wLjEyOS0zLjk1MmMwLjA3Ny0wLjA4MSwyLjE2Ny0yLjEyMiw1Ljg5OS01LjEzMkwwLjgyLDY2LjUzNGMtMS4wOTMtMS4wOTItMS4wOTMtMi44NjksMC0zLjk2Mg0KCQljMS4wOS0xLjA5MiwyLjg2OS0xLjA5MiwzLjk2MSwwbDExLjI4NSwxMS4yODZjNi4wOC00LjQ1NSwxNC41NzMtOS44MjIsMjQuODI2LTE0LjIyMUwzMi45Miw0NS4zNjYNCgkJYy0wLjc1NC0xLjM1My0wLjI3My0zLjA2MywxLjA3Ni0zLjgxN2MxLjM0MS0wLjc0NywzLjA1NC0wLjI4MiwzLjgxNiwxLjA3NWw4LjMzMSwxNC45MjJjOC45NzItMy4zMTYsMTkuMDM0LTUuNjU5LDI5Ljg1LTUuOTY3DQoJCVYzMy43MzNjMC0xLjU0NywxLjI1Ny0yLjgwMywyLjgwMi0yLjgwM2MxLjU0OCwwLDIuODAyLDEuMjU2LDIuODAyLDIuODAzdjE3Ljg4NWMxMC43MjgsMC40MiwyMC43NjYsMi44MDcsMjkuNzMxLDYuMTQyDQoJCWw4LjQ1NS0xNS4xNDJjMC43NTUtMS4zNTcsMi40NTEtMS44MjgsMy44MTktMS4wNzZjMS4zNDYsMC43NTYsMS44MjksMi40NiwxLjA3MywzLjgxN2wtOC4xLDE0LjUwMQ0KCQljMTAuMjMzLDQuMzg1LDE4Ljc0Nyw5LjY5MywyNC44NzEsMTQuMDlsMTEuMzc1LTExLjM4NGMxLjA5Mi0xLjA5MiwyLjg3NS0xLjA5MiwzLjk2MywwDQoJCUMxNTcuODY4LDYzLjY1OCwxNTcuODUxLDY1LjQzNywxNTYuNzYyLDY2LjUzNHoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K"
                                                        style="width: 50%; margin-left: auto; margin-right: auto" />
                                                    <span>{{ $category->name }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END SECTION CATEGORIES -->

    <!-- START SECTION SHOP -->
    <div class="section small_pt pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s4 text-center">
                        <h2>@lang('home.best')</h2>
                    </div>
                    <p class="text-center leads">@lang('home.eyelashes')</p>
                </div>
            </div>
            <div class="row shop_container">
                {{-- @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="product_box text-center">
                            <div class="product_img">
                                <a href="{{ url('product_detail/' . $product->id) }}">
                                    <img class="card-img-top" src="{{ URL($product->image) }}" style="width: auto !important; height: auto !important; max-width: 100%;">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li><a href="//bestwebcreator.com/shopwise/demo/shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                        <li><a href="{{ url('product_detail/' . $product->id) }}" class=""><i
                                                    class="icon-magnifier-add"></i></a></li>
                                        <li><a href="#"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a
                                        href="{{ url('product_detail/' . $product->id) }}">{{ $product->name }}</a>
                                </h6>
                                <div class="product_price">
                                    <span class="price">${{ $product->price }} MXN</span>
                                    <del>$ {{ $product->discount }}</del>
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
                                    <p></p>
                                </div>
                                <div class="add-to-cart">
                                    <a href="{{ url('add_to_cart/' . $product->id) }}"
                                        class="btn btn-fill-out btn-radius"><i class="icon-basket-loaded"></i> @lang('home.add')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                <div class="col-md-12" align="center">
                    <a href="{{ url('products') }}" class="btn btn-fill-out btn-radius">
                        <i class="icon-basket-loaded"></i> Ver productos
                    </a>
                </div>
            </div>
        </div>

        <br>
        <br>    

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_s4 text-center">
                        <h2>Promociones</h2>
                    </div>
                </div>
                @foreach ($promotions as $promotion)
                    <div class="col-md-4" align="center">
                        @if($promotion->image != null)
                            <img src="{{ URL($promotion->image) }}" style="width: auto !important; height: auto !important; max-width: 100%;">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <br>
        <br>  

        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12" align="center">
                    <!-- <video width="100%" height="600" loop controls>
                        <source src="background_video.mp4" type="video/mp4">
                    </video> -->
                </div>
            </div>
        </div>
        
    </div>
    <!-- END SECTION SHOP -->

    <section class="hero-wrap d-flex parallax"
        style="height: 500px; background-image: url('{{ asset('backgrounds/three_bg.jpg') }}'); background-size:cover; background-position: center center; margin-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" align="center" style="margin-top: 200px;">
                    <h2 style="font-size: 42px; text-shadow: 3px 3px 3px #000; color: #fff;" align="center">
                        {{-- @lang('home.quality') --}}

                        La mejor calidad y precio.
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- START SECTION BLOG -->
    {{-- <div class="section small_pt pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="heading_s1 text-center">
                        <h2>Post Nuevos</h2>
                    </div>
                    <p class="leads text-center">Siguenos en nuestras redes sociales.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="blog-single.html">
                                <img src="assets/images/furniture_blog_img1.jpg" alt="furniture_blog_img1">
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title"><a href="blog-single.html">But I must explain to you how all this
                                        mistaken idea</a></h5>
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-calendar"></i> April 14, 2018</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                                    anything hidden in the text</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="blog-single.html">
                                <img src="assets/images/furniture_blog_img2.jpg" alt="furniture_blog_img2">
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title"><a href="blog-single.html">On the other hand we provide denounce
                                        with righteous</a></h5>
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-calendar"></i> April 14, 2018</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                                    anything hidden in the text</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="blog-single.html">
                                <img src="assets/images/furniture_blog_img3.jpg" alt="furniture_blog_img3">
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title"><a href="blog-single.html">Why is a ticket to Lagos so
                                        expensive?</a></h5>
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-calendar"></i> April 14, 2018</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                                    anything hidden in the text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END SECTION BLOG -->
</div>
<!-- END MAIN CONTENT -->

@push('script')
    <script>

    </script>
@endpush

@endsection
