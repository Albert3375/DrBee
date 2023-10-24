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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


<!-- START SECTION BANNER -->
<div class="banner_section full_screen staggered-animation-wrap" style="height: 3500%;">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow carousel_style2"
        data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active background_bg overlay_bg_50"  data-img-src="img/zoo.jpg">
                <div class="banner_slide_content banner_content_inner">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10">
                                <div class="banner_content text_white text-center">
                                    <!-- Agrega tu contenido aquí -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item background_bg overlay_bg_50" data-img-src="img/zoo2.jpg">
                <div class="banner_slide_content banner_content_inner">
                    <div class="container">
                        <div class="row justify_content-center">
                            <div class="col-lg-7 col-md-10">
                                <div class="banner_content text_white text-center">
                                    <!-- Agrega tu contenido aquí -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item background_bg overlay_bg_60" data-img-src="img/zoo3.jpg">
                <div class="banner_slide_content banner_content_inner">
                    <div class="container">
                        <div class="row justify_content-center">
                            <div class="col-lg-7 col-md-10">
                                <div "banner_content text_white text-center">
                                    <!-- Agrega tu contenido aquí -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i
                class="ion-chevron-left"></i></a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i
                class="ion-chevron-right"></i></a>
    </div>
</div>
<!-- END SECTION BANNER -->

<script>
    $(document).ready(function () {
        // Iniciar el carrusel
        $('#carouselExampleControls').carousel();
    });
</script>


<section class="image-carousel">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
  
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12">
                <div class="slick-carousel">
                    <div><img src="img/hikari-1.jpg" alt="Imagen 1"></div>
                    <div><img src="img/oceanaqua-1.jpg" alt="Imagen 2"></div>
                    <div><img src="img/acuamex-1.jpg" alt="Imagen 3"></div>
                    <div><img src="img/acuario-lomas-1.jpg" alt="Imagen 4"></div>
                    <div><img src="img/red-sea-1.jpg" alt="Imagen 5"></div>
                    <div><img src="img/tetra-1.jpg" alt="Imagen 6"></div>
                    <div><img src="img/tropical-1.jpg" alt="Imagen 7"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function(){
    $('.slick-carousel').slick({
        infinite: true,     // Hace que el carrusel sea infinito
        slidesToShow: 4,    // Cantidad de imágenes visibles a la vez
        slidesToScroll: 1,  // Cuántas imágenes avanzan al hacer clic en las flechas
        autoplay: true,     // Inicia la reproducción automática
        autoplaySpeed: 100,  // Velocidad de la reproducción automática en milisegundos
        swipe: true,        // Permite a los usuarios arrastrar el carrusel con el cursor
        speed: 5000,        // Velocidad de desplazamiento en milisegundos
        cssEase: 'linear'   // Hace que el desplazamiento sea lineal
    });
});

</script>



<!-- Fin de la sección de Galería de Imágenes -->

<!-- Estilo CSS personalizado para permitir el desplazamiento del carrusel con el mouse -->
<style>
    .carousel {
        cursor: grabbing !important;
    }

    .carousel:active {
        cursor: grabbing !important;
    }

    .image-carousel {
    overflow: hidden;
    width: 100%;
}

.images {
    white-space: nowrap;
    transition: transform 1s ease;
}

.images img {
    display: inline-block;
    width: 300px; /* Ancho de cada imagen */
    height: auto;
}


</style>


    <!-- START SECTION SHOP -->
    <div class="section small_pt pb_70"  style="background-color: #002B4D;">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-6">
                    <div class="heading_s4 text-center">
                        <h2 style="color: #fff;">@lang('home.best')</h2>
                    </div>
                    <p class="text-center leads" style="color: #fff;">@lang('home.eyelashes')</p>
                    <p style="color: #fff;">Sabemos lo importante que es tu mascota para ti, es por ello que en Zoofish, trabajamos para tener la más amplia gama de productos para acuario y mascotas. Somos distribuidores autorizados de las mejores marcas.</p>

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

     
        
    </div>

    <br><br>
    <!-- END SECTION SHOP -->
<!-- Sección Zoofish Pets -->
<section class="zoofish-pets">
  <div class="container">
    <div class="row">
      <div class="col-md-6" >
      <img src="{{ asset('img/zoofish-pets.png') }}" alt="Mascotas" style="width: 50%;">
    
        <p>En Zoofish, nos preocupamos por la calidad de vida de tus mascotas. Es por eso que presentamos nuestra división de Pets, que ofrece un extenso catálogo de alimentos y accesorios para una variedad de pequeñas especies, incluyendo perros, gatos, roedores y aves.</p>
      </div>
      <div class="col-md-6">
        <!-- Puedes agregar una imagen aquí -->
     
      </div>
    </div>
  </div>
</section>



<br><br>


<section class="catalog-section" style="background-color: #002B4D;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 style="color: #fff;">Catálogo Zoofish Pets para Pequeñas Especies</h2>
                <p style="color: #fff;">Más de 200 páginas de productos clasificados por categorías. Te invitamos a descargar nuestro último catálogo para encontrar lo que tu negocio necesita a excelentes precios.</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('img/catalog.jpg') }}" alt="Catálogo 1" class="float-right">
            </div>
        </div>
    </div>
</section>


    <br><br>
    <section class="por-que-comprar" >
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h2 class="section-title">Por qué comprar con nosotros</h2>
                </div>
            </div>
            <div class="row">
                <!-- Primer elemento -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature">
                        <img src="{{ asset('img/ventas.jpg') }}" alt="Envío a todo México" class="feature-image">
                        <h3 class="feature-title">Envío a todo México</h3>
                        <p class="feature-description">Contamos con un sistema de logística y envíos, lo cual nos permite mandar de manera efectiva y rápida toda nuestra gama de productos a toda la República Mexicana.</p>
                    </div>
                </div>

                <!-- Segundo elemento -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature">
                        <img src="{{ asset('img/variedad.jpg') }}" alt="Gran Variedad y Surtido" class="feature-image">
                        <h3 class="feature-title">Gran Variedad y Surtido</h3>
                        <p class="feature-description">En Zoofish contamos con la más amplia variedad de accesorios y equipos de venta al mayoreo para tu negocio.</p>
                    </div>
                </div>

                <!-- Tercer elemento -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature">
                        <img src="img/ahorro.jpg" alt="Los Mejores Precios" class="feature-image">
                        <h3 class="feature-title">Los Mejores Precios</h3>
                        <p class="feature-description">Sé competitivo en tu negocio. Zoofish te ofrece los mejores precios del mercado en peces y accesorios para mascotas. Cotiza con nosotros.</p>
                    </div>
                </div>

                <!-- Cuarto elemento -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature">
                        <img src="img/negocios.jpg" alt="Confianza en Tus Compras" class="feature-image">
                        <h3 class="feature-title">Confianza en Tus Compras</h3>
                        <p class="feature-description">Más de 30 años de experiencia nos respaldan. Somos una empresa confiable en la comercialización y venta al mayoreo de equipos y accesorios.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style>
    /* Estilos para la sección "Por qué comprar con nosotros" */
.por-que-comprar {
    background-color: #fff ;
    padding: 60px 0;
}

.section-title {
    color: #333;
}

.feature {
    background-color: #fff;
    border: 3px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    text-align: center;
}

.feature-image {
    max-width: 100%;
}

.feature-title {
    font-size: 18px;
    margin-top: 20px;
}

.feature-description {
    font-size: 14px;
    color: #777;
}

/* Estilos responsivos */
@media (max-width: 768px) {
    .feature {
        margin: 0 0 20px;
    }
}

</style>
    



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
