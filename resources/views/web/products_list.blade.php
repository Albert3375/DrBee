@extends('web.partials.master')

@section('title', 'Productos')

@section('content')

@php
    use App\Models\Comment;
@endphp

<!-- Hero Section -->
<section class="hero-wrap d-flex parallax" style="height: 400px; background-image: url('{{ asset('img/dr.png') }}'); background-size: cover; background-position: center center; margin-top: 70px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-title">
                    <h1 style="font-size: 50px; text-shadow: 3px 3px 3px #000; color: #fff; margin-top: 200px;" class="text-center">@lang('products.products')</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="main_content">

    <!-- Shop Section -->
    <div class="section">
        <div class="container">
            <div class="row">

                <!-- Sidebar for Categories -->
           <!-- Sidebar for Categories -->
<div class="col-lg-3 mt-4 pt-2 mt-lg-0 pt-lg-0">
    <div class="sidebar">
        <div class="widget">
            <h5 class="widget_title">@lang('products.categories')</h5>
            <ul class="list-group category-list" id="category-list">
                <li class="list-group-item"><a href="#" data-category-id="0">Mostrar todo</a></li>
                @foreach ($categories as $category)
                    <li class="list-group-item">
                        <a href="#" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<style>

.category-list {
    padding: 0;
    margin: 0;
    list-style: none;
    border: none;
}

.category-list .list-group-item {
    background-color: #f8f9fa; /* Light background for each item */
    border: none;
    border-bottom: 1px solid #e0e0e0;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-size: 16px;
    padding: 10px 20px;
    position: relative;
    cursor: pointer;
}

.category-list .list-group-item:first-child {
    border-top: none;
}

.category-list .list-group-item:last-child {
    border-bottom: none;
}

.category-list .list-group-item:hover {
    background-color: #ffc107; /* Highlight color on hover */
    color: #fff; /* White text on hover */
}

.category-list .list-group-item a {
    text-decoration: none;
    color: inherit; /* Use the color of the parent element */
    display: block;
    width: 100%;
}

.category-list .list-group-item.active {
    background-color: #ffc107;
    color: #fff;
    font-weight: bold;
}

</style>


                <!-- Product List -->
                <div class="col-lg-9 mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <div class="product_header">
                        {!! Form::open(array('url' => 'search', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search')) !!}
                            <div class="form-group row">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" placeholder=@lang('products.search') value={{ isset($query) ? $query : '' }}>
                                    <span class="input-group-btn">
                                        <button class="btn btn-md btn-fill-out" type="submit" style="height: 100%;">@lang('products.search')</button>
                                    </span>
                                </div>
                            </div>
                        {{ Form::close() }}
                        <div class="product_header_right form-group row">
                            <div class="products_view">
                                <a href="javascript:void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                <a href="javascript:void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row shop_container grid" id="product-list">
                        @foreach ($products as $product)
                            <div class="col-md-4 mb-4 product-item">
                                <div class="product">
                                    @if($product->stock == "0")
                                        <span class="pr_flash">AGOTADO</span>
                                    @endif

                                    <div class="product_img" align="center">
                                        <a href="{{ url('product_detail/'.$product->id) }}">
                                            <img src="{{ asset($product->image) }}" style="width: auto; height: auto; max-width: 100%;">
                                        </a>

                                        @if($product->stock != "0")
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <!-- Botón modificado -->
                                                    <li class="ask-whatsapp">
                                                        <a href="https://wa.me/3332250942?text=%C2%A1Hola!%20Estoy%20interesado%20en%20el%20producto%20{{ urlencode($product->name) }}.%20%C2%BFPodr%C3%ADa%20darme%20m%C3%A1s%20informaci%C3%B3n?" target="_blank">
                                                            <i class="fab fa-whatsapp"></i>@lang('products.ask_whatsapp', ['product' => $product->name])
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="product_info">
                                        <h6 class="product_title"><a href="{{ url('product_detail/'.$product->id) }}">{{ $product->name }}</a></h6>
                                        <div class="product_price"></div>

                                        @php
                                            $comments = Comment::where('products_id', $product->id)->get();
                                            $rating = 0;
                                            if ($comments->count() > 0) {
                                                foreach ($comments as $comment) {
                                                    $rating += $comment->rating;
                                                }
                                                $rating = ($rating / $comments->count()) * 20;
                                            }
                                        @endphp
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:{{ $rating }}%"></div>
                                            </div>
                                            <span class="rating_num">{{ $comments->count() }}</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>{{ $product->description }}</p>
                                        </div>

                                        @if($product->stock != "0")
                                            <div class="add-to-cart" align="center">
                                                <a href="https://wa.me/3332250942?text=%C2%A1Hola!%20Estoy%20interesado%20en%20el%20producto%20{{ urlencode($product->name) }}.%20%C2%BFPodr%C3%ADa%20darme%20m%C3%A1s%20informaci%C3%B3n?" class="btn btn-fill-out btn-radius">
                                                    <i class="fab fa-whatsapp"></i> Preguntar por WhatsApp
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination justify-content-center pagination_style1" id="pagination">
                                @if ($products->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="linearicons-arrow-left"></i></a></li>
                                @endif
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    @if ($i == $products->currentPage())
                                        <li class="page-item active"><a class="page-link" href="#">{{ $i }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor
                                @if ($products->currentPage() != $products->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="linearicons-arrow-right"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <section class="hero-wrap d-flex parallax" style="height: 400px; background-image: url('{{ asset('backgrounds/three.jpg') }}'); background-size: cover; background-position: center center; margin-top: 70px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <h2 class="text-light">@lang('products.subscribe')</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="section bg_default small_pt small_pb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="heading_s1 mb-md-0 heading_light">
                        <h3>@lang('products.newsletter')</h3>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="newsletter_form">
                        <form method="get" action="{{ URL('news_letter') }}">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <input type="text" required class="form-control" placeholder="@lang('products.name')" name="name">
                                </div>
                                <div class="col-md-5">
                                    <input type="email" required class="form-control" placeholder="@lang('products.email')" name="email">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-lg btn-info" style="border-radius: 24px;">@lang('products.subscribe')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('script')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const categoryList = document.getElementById('category-list');
    const productList = document.getElementById('product-list');
    const pagination = document.getElementById('pagination');

    categoryList.addEventListener('click', function(event) {
        event.preventDefault();
        if (event.target.tagName === 'A') {
            const categoryId = event.target.getAttribute('data-category-id');

            // Hacer una petición AJAX al servidor
            fetch(`/api/products${categoryId !== "0" ? `?category=${categoryId}` : ''}`)
                .then(response => response.json())
                .then(data => {
                    let productsHtml = '';
                    data.products.forEach(product => {
                        productsHtml += `
                            <div class="col-md-4 mb-4 product-item">
                                <div class="product">
                                    ${product.stock == "0" ? '<span class="pr_flash">AGOTADO</span>' : ''}

                                    <div class="product_img" align="center">
                                        <a href="product_detail/${product.id}">
                                            <img src="${product.image}" style="width: auto; height: auto; max-width: 100%;">
                                        </a>
                                        ${product.stock != "0" ? `
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="ask-whatsapp">
                                                        <a href="https://wa.me/3332250942?text=%C2%A1Hola!%20Estoy%20interesado%20en%20el%20producto%20${encodeURIComponent(product.name)}.%20%C2%BFPodr%C3%ADa%20darme%20m%C3%A1s%20informaci%C3%B3n?" target="_blank">
                                                            <i class="fab fa-whatsapp"></i> Preguntar por WhatsApp
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        ` : ''}
                                    </div>

                                    <div class="product_info">
                                        <h6 class="product_title"><a href="product_detail/${product.id}">${product.name}</a></h6>
                                        <div class="product_price"></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:${product.rating}%"></div>
                                            </div>
                                            <span class="rating_num">${product.comments_count}</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${product.description}</p>
                                        </div>
                                        ${product.stock != "0" ? `
                                            <div class="add-to-cart" align="center">
                                                <a href="https://wa.me/3332250942?text=%C2%A1Hola!%20Estoy%20interesado%20en%20el%20producto%20${encodeURIComponent(product.name)}.%20%C2%BFPodr%C3%ADa%20darme%20m%C3%A1s%20informaci%C3%B3n?" class="btn btn-fill-out btn-radius">
                                                    <i class="fab fa-whatsapp"></i> Preguntar por WhatsApp
                                                </a>
                                            </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    productList.innerHTML = productsHtml;
                    pagination.innerHTML = ''; // Opcional: Limpiar la paginación o actualizarla según sea necesario
                })
                .catch(error => console.error('Error fetching products:', error));
        }
    });
});

</script>
@endpush

@endsection
