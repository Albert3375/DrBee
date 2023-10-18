@extends('web.partials.master')

@section('title', 'Outlet')

@section('content')

@php
    use App\Models\Comment;
@endphp

<!-- START SECTION BREADCRUMB -->
<section class="hero-wrap d-flex parallax" style="height: 500px; background-image: url('{{ asset('backgrounds/two_bg.jpg') }}'); background-size:cover; background-position: center center; margin-top: 70px;">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        <h1 style="font-size: 50px; text-shadow: 3px 3px 3px #000; color: #fff; margin-top: 200px;" align="center">
                        	Outlet
                        </h1>
                    </div>
                </div>
            </div>
        </div><!-- END CONTAINER-->
</section>

<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12" align="center">
        <div class="shadow card bg-light">
          <div class="card-body" align="center">
            <div class="row">
              <div class="col-md-6" align="center">
                <img src="{{ asset('img/footer-logo.png') }}" style="width: auto !important; height: auto !important; max-width: 80%; margin-top: 80px;">
              </div>
              <div class="col-md-6" align="center">
                <img src="{{ asset('img/ladymoon.png') }}" style="width: auto !important; height: auto !important; max-width: 70%;">
              </div>
            </div>
          </div>
         <div class="card-body">
            <h2 class="mb-2">
              <i class="fa fa-percent"></i>
              OFERTA ESPECIAL PARA NUESTROS CLIENTES HASTA AGOTAR EXISTENCIAS 
              <i class="fa fa-percent"></i>
            </h2>
            <hr>
            <div class="mt-4 mt-lg-1 row">

               <div class="col-lg-12 col-sm-12">
                    <h3>
                    SI LA COMPRA EXCEDE LAS 100 PIEZAS ENTRE PESTAÑA Y LABIAL EL ENVIO ES GRATIS.
                  </h3>
                  <h3>
                    EL ENVIO TAMBIEN ES GRATIS DEL OUTLET. 
                  </h3>
                  <h3>
                    SOLICITA INFORMES.
                  </h3>
               </div>

             </div>
           </div>
         </div>
         <br>
       </div>
    </div>
  </div>
</section>

<section class="hero-wrap d-flex parallax" style="height: 200px; background-image: url('{{ asset('img/outlet.jpg') }}'); background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-md-12" align="center">
                {{-- <h2 style="font-size: 50px; text-shadow: 3px 3px 3px #000; color: #fff;" align="center">
                     <i class="fa fa-percent"></i>
                     Outlet 
                     <i class="fa fa-percent"></i>
                </h2> --}}
            </div>
        </div>
    </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12" align="center">
        <h1>
          ALTA GAMA DE LABIALES Y PESTAÑAS
        </h1>
        <h2>
          PRECIO DE INTRODUCCIÓN
        </h2>
      </div>
      @foreach($products as $product)
          <div class="col-md-4" align="center" style="margin-top: 20px;">
            <div class="card" style="border-radius: 5px;">
              @if($product->img != null)
                <img class="card-img-top" src="{{ URL($product->img) }}" style="width: auto !important; height: auto !important; max-width: 100%; border-radius: 5px;">
              @else
                  Sin imagen disponible.
              @endif
              <div class="card-body">
                <h3 class="card-title">{{ $product->name }}</h3>
                <h5>Precio: ${{ $product->price }}.00</h5>
                <h5>Categoría: {{ $product->category }}</h5>
                <p class="card-text">
                  {{ $product->description }}
                </p>
               {{--  <a class="btn btn-warning" href="{{ route('detailsproduct', $product->id) }}">Más detalles</a> --}}
                {{-- <a class="btn btn-success" style="font-size: 22px; width: 210px;" href="{{ url('add_to_cart/'.$product->id)}}">
                  <i class="fas fa-cart-plus"></i> Añadir al Carrito
                </a> --}}
              </div>
            </div>
          </div>
      @endforeach
    </div>
  </div>
</section>


<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION BREADCRUMB -->
<section class="hero-wrap d-flex parallax"
style="height: 400px; background-image: url('{{ asset('backgrounds/two_bg.jpg') }}'); background-size:cover; background-position: center center; margin-top: 70px;">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        <h1 style="font-size: 30px; text-shadow: 3px 3px 3px #000; color: #fff; margin-top: 10%" align="center">
                        </h1>
                    </div>
                </div>
            </div>
        </div><!-- END CONTAINER-->
</section>

<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
	<div class="container">
    	<div class="row align-items-center">
            <div class="col-md-6">
                <div class="heading_s1 mb-md-0 heading_light">
                    <h3>@lang('products.newsletter')</h3>
                </div>
            </div>
            <div class="col-md-5">
                <div class="newsletter_form">
                    <form method="get" action="{{ URL('news_letter') }}">
                    <div class="form-group row">
                        <div class="col-md-8">
                        <input type="text" required="" class="form-control rounded-0" placeholder=@lang('products.name') name="name" required>
                        </div>
                    </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="text" required="" class="form-control rounded-0" placeholder=@lang('products.email') name="email"  required>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-1" align="center">
                        <button type="submit" class="btn btn-dark rounded-0" name="submit" value="Submit">@lang('products.suscribe')</button>
                    </div>
                </form>

        </div>
    </div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>
<!-- END MAIN CONTENT -->


@push('script')
<script>

</script>
@endpush

@endsection
