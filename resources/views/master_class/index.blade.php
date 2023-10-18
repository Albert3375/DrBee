@extends('master_class.partials.master')

@section('title', 'Master Class')

@section('content')

<div class="service-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="section-title text-center mb-65">
                <h3>
                  NUESTROS CURSOS MASTER CLASS
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-4" align="center">
                <div class="single-service">
                    <div class="service-thumb">
                        <img src="https://Zoofish.com.mx/cursos/public/asset/img/inicio/1611847170NAHOMI 468 X 638.jpg" alt="">
                    </div>
                    <h4>MAQUILLAJE DE NOVIA</h4>
                    <p>$19.00 USD</p>
                    <a href="{{ URL('/course_detail') }}" style="color:#fff;" class="btn btn-lg btn-info"><i class="fa fa-eye"></i> Ver Curso</a>
                    <a href="#" style="color:#fff;" class="btn btn-lg btn-success"><i class="fa fa-dollar"></i> Comprar</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-4" align="center">
                <div class="single-service">
                    <div class="service-thumb">
                        <img src="https://Zoofish.com.mx/cursos/public/asset/img/inicio/1611846327LIDIA 468X368.jpg" alt="">
                    </div>
                    <h4>BODY PAINT MASTER CLASS</h4>
                    <p>$19.00 USD</p>
                    <a href="{{ URL('/course_detail') }}" style="color:#fff;" class="btn btn-lg btn-info"><i class="fa fa-eye"></i> Ver Curso</a>
                    <a href="#" style="color:#fff;" class="btn btn-lg btn-success"><i class="fa fa-dollar"></i> Comprar</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-4" align="center">
                <div class="single-service">
                    <div class="service-thumb">
                        <img src="https://Zoofish.com.mx/cursos/public/asset/img/inicio/1611784808468x368.jpg" alt="">
                    </div>
                    <h4>PIEL MADURA CON HILOS TENSORES</h4>
                    <p>$19.00 USD</p>
                    <a href="{{ URL('/course_detail') }}" style="color:#fff;" class="btn btn-lg btn-info"><i class="fa fa-eye"></i> Ver Curso</a>
                    <a href="#" style="color:#fff;" class="btn btn-lg btn-success"><i class="fa fa-dollar"></i> Comprar</a>
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
