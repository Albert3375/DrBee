@php
    use App\Models\Comment;
@endphp
@extends('web.partials.master')

@section('title', 'Detalle del Producto')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
          <div class="col-md-6">
                <div class="page-title">
                <h1>@lang('products.details')</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href={{ URL('/')}}>@lang('menu.home')</a></li>
                    <li class="breadcrumb-item active">@lang('products.details')</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
  <div class="container">
    <div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
              <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img" src="{{ URL($product->image) }}" data-zoom-image="assets/images/product_zoom_img1.jpg" alt="product_img1" />
                        <a href="#" class="product_img_zoom" title="Zoom">
                            <span class="linearicons-zoom-in"></span>
                        </a>
                    </div>
                    <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                        <div class="item">
                            <a href="#" class="product_gallery_item active" data-image="assets/images/product_img1.jpg" data-zoom-image="assets/images/product_zoom_img1.jpg">
                                <img src="{{ URL($product->image) }}" alt="product_small_img1" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" style="margin-top: 100px">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title"><a href="#">{{$product->name}}</a></h4>
                        <div class="product_price">
  
</div>

                        <div class="rating_wrap">
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
                                <div class="rating">
                                    <div class="product_rate" style="width:{{$rating}}%"></div>
                                </div>
                                <span class="rating_num">{{$comments->count()}}</span>
                            </div><br><br>
                        <div>
                            <ul class="product-meta">
                                <li>@lang('products.category'): <a href="#">{{$category->name}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" onclick="rest({{$product->id}})" value="-" class="minus">
                                <input id="quantity" type="text" disabled name="quantity" value="1" title="Qty" class="qty" size="4">
                                <input type="button" onclick="add({{$product->id}})"  value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <a href="{{ url('add_to_cart/'.$product->id)}}" class="btn btn-fill-out "><i class="icon-basket-loaded"></i>  @lang('home.add')</a>
                        </div>
                    </div>
                    <hr />
                    <div class="product_share">
                        <span>@lang('products.share'):</span>
                        <ul class="social_icons">
                            <li><a href="https://www.facebook.com/Zoofish3D"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/Zoofishlashes/"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-12">
              <div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
          <div class="col-12">
              <div class="tab-style3">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">@lang('products.description')</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">@lang('products.comments')</a>
                        </li>
                    </ul>
                  <div class="tab-content shop_info_tab">
                        <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                          <p>{{$product->description}}.</p>
                        </div>
                        <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                          <div class="comments">
                              <h5 class="product_tab_title">@lang('products.comments_of')<span>{{$product->name}}</span></h5>
                                <ul class="list_none comment_list mt-4">
                                    @foreach($comments as $comment)
                                        <li>
                                            <div>
                                                <div class="rating_wrap" align="right">
                                                    <div class="rating">
                                                        @php
                                                            $rating = $comment->rating * 20;
                                                        @endphp
                                                        <div class="product_rate" style="width:{{$rating}}%"></div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="customer_meta">
                                                        <span class="review_author">{{$comment->username}}</span>
                                                        <span class="comment-date">{{$comment->created_at}}</span>
                                                    </p>
                                                </div>
                                                <div class="description">
                                                    <p>{{$comment->message}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                          </div>
                            <div class="review_form field_form">

                                <h5>@lang('products.add_comment')</h5>
                                {!! Form::open(['action'=> ['CommentsController@store'] ]) !!}
                                <form class="row mt-3" action="CommentsController@store">

                                    <div class="form-group col-12">
                                        <input type="hidden" name="product_id" value={{$product->id}}>
                                        <input type="hidden" id="ratingVal" name="Star_rating">
                                        <div class="star_rating">
                                            <span data-value="1"><i class="far fa-star"></i></span>
                                            <span data-value="2"><i class="far fa-star"></i></span>
                                            <span data-value="3"><i class="far fa-star"></i></span>
                                            <span data-value="4"><i class="far fa-star"></i></span>
                                            <span data-value="5"><i class="far fa-star"></i></span>
                                            <input type="hidden" value="5" name="rating">
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-group col-12">

                                        <textarea required="required" placeholder=@lang('products.your_comment') class="form-control" name="message" rows="4"></textarea>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder=@lang('products.your_name') class="form-control" name="username" type="text">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder=@lang('products.your_email') class="form-control" name="email" type="email">
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">@lang('products.send')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-12">
              <div class="small_divider"></div>
              <div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
          <div class="col-12">
              <div class="heading_s1">
                  <h3>@lang('products.related')</h3>
                </div>
              <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                @foreach($products as $product)
                <div class="item">
                        <div class="product">
                            <div class="product_img">
                                <a href="shop-product-detail.html">
                                    <img src="{{ URL($product->image) }}" style="width: 300px !important; height: 250px !important; border-radius: 5px;">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart"><a href="{{ url('add_to_cart/'.$product->id)}}"><i class="icon-basket-loaded"></i> @lang('products.add')</a></li>
                                        <li><a href="{{ url('product_detail/'.$product->id)}}" class=""><i class="icon-magnifier-add"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{ url('product_detail/'.$product->id)}}">{{ $product->name }}</a></h6>
                                <div class="product_price">
   
</div>

                                <div class="rating_wrap">
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
                                    <div class="rating">
                                        <div class="product_rate" style="width:{{$rating}}%"></div>
                                    </div>
                                    <span class="rating_num">{{$comments->count()}}</span>
                                </div>
                                <div class="pr_desc">
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->

@push('script')
<script>
    function add(id){
        var quantity = $('#quantity').val();
        var data = {
            'id' : id,
            'quantity' : quantity,
        }

        $.get('{{ url("addProduct")}}',data,function(dato){
            if(dato == "yes"){
                $('#price-'+id).load(' #priceSpan-'+id);
                $('#total').load(' #totalSpan');
            }
        })
    }

    function rest(id){
        var quantity = $('#quantity').val();
        var data = {
            'id' : id,
            'quantity' : quantity,
        }

        $.get('{{ url("restProduct")}}',data,function(dato){
            if(dato == "yes"){
                $('#price-'+id).load(' #priceSpan-'+id);
                $('#total').load(' #totalSpan');
            }
        })
    }
</script>
@endpush

@endsection
