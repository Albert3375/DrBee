@extends('master_class.partials.master')

@section('title', 'Curso - Master Class')

@section('content')

<div class="about-area section-padding">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-xl-7 col-md-12 col-lg-6">
              <div class="about-thumb">
                  <img src="https://Zoofish.com.mx/cursos/public/asset/img/inicio/1611847170NAHOMI 468 X 638.jpg" alt="">
                  <a class="video-icon popup-video" href="https://player.vimeo.com/video/494244110">
                      <i class="fa fa-play"></i>
                  </a>
              </div>
          </div>
          <div class="col-xl-5 col-md-12 col-lg-6" align="center">
              <div class="section-title mb-65">
                  <span>Contenido del Curso</span>
                  <h3>MAQUILLAJE DE NOVIA</h3>
                  <p class="para-text">
                      Nahomi Mejía nos enseña paso a paso como hacer lucir a una novia radiante y natural.
                  </p>
                  <p style="font-size: 20px;" class="para-text"><span style="font-size: 24px;">$19.00 USD</span>PRECIO ACTUAL</p>
                  <a href="#" style="color:#fff;" class="btn btn-md btn-success"><i class="fa fa-dollar"></i> Comprar</a>
                  <div class="name">
                      <img src="img/about/name.png" alt="">
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="counter-area gray-bg" style="margin-top: -100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12" align="center">
              <h2><i class="fa fa-info-circle"></i> MAKE UP ARTIST</h2>
              <br>
            </div>
            <div class="col-md-6" align="center">
              <h3>
                <a href="">
                  <i class="fa fa-play-circle-o"></i> Sesiones
                </a>
              </h3>
            </div>
            <div class="col-md-6" align="center">
              <h3>
                <a href="">
                  <i class="fa fa-play-circle-o"></i> Master Class
                </a>
              </h3>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>

</script>
@endpush

@endsection
