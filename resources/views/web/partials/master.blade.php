<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="IA Society" />
    <meta name="copyright" content="Zoofish" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="keywords" content="Zoofish, IA Society"/>
    <meta name="robots" content="index,follow" />
    <meta name="description" content="Zoofish" />
    <meta name="distribution" content="global" />
    <meta name="resource-type" content="document" />

    <title> @yield('title') - Zoofish</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png')}}" />

    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/simple-line-icons.css')}}">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/css/owl.theme.default.min.css')}}">
    <!-- Magnific Popup CSS -->
    <!-- <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}"> -->
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">

    <!-- <link rel="stylesheet" href="{{asset('web/css/flaticon.css')}}"> -->

    <script type="text/javascript">
      document.oncontextmenu = function(){return false;}
    </script> 

  </head>

  <style>
    .float{
      position:fixed;
      width:60px;
      height:60px;
      bottom:40px;
      right:40px;
      background-color:#25d366;
      color:#FFF;
      border-radius:50px;
      text-align:center;
      font-size:30px;
      box-shadow: 2px 2px 3px #999;
      z-index:100;
    }

    .my-float{
      margin-top:16px;
    }

    .loading {
    position: fixed;
    z-index: 999999999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    }

    .loading:before {
    content: "";
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(rgba(20, 20, 20, 0.8), rgba(0, 0, 0, 0.8));

    background: -webkit-radial-gradient(
        rgba(20, 20, 20, 0.8),
        rgba(0, 0, 0, 0.8)
    );
    }

    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
    }

    .loading:not(:required):after {
    content: "";
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: spinner 150ms infinite linear;
    -moz-animation: spinner 150ms infinite linear;
    -ms-animation: spinner 150ms infinite linear;
    -o-animation: spinner 150ms infinite linear;
    animation: spinner 150ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0,
        rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0,
        rgba(255, 255, 255, 0.75) 0 1.5em 0 0,
        rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0,
        rgba(255, 255, 255, 0.75) -1.5em 0 0 0,
        rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0,
        rgba(255, 255, 255, 0.75) 0 -1.5em 0 0,
        rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0,
        rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0,
        rgba(255, 255, 255, 0.75) 0 1.5em 0 0,
        rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0,
        rgba(255, 255, 255, 0.75) -1.5em 0 0 0,
        rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0,
        rgba(255, 255, 255, 0.75) 0 -1.5em 0 0,
        rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    }
    /* Animation */

    @-webkit-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
    @-moz-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
    @-o-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
    @keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
  </style>

<body>

<div class="preloader">
    <!-- Utiliza un archivo GIF como animación de carga -->
    <img src="{{ asset('assets/images/loadingdog.gif') }}" alt="Cargando..."  >
</div>


<style>
  /* styles.css */
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}


</style>
 <!-- @yield('popup')  -->

  @include('web.partials.nav')

  @yield('content')

  @include('web.partials.footer')

<a href="https://api.whatsapp.com/send?phone=+525579429702&text=hola%21%20quisiera%20m%c3%a1s%20informaci%c3%b3n%20sobre%20zoofish%20😊❤️." class="float" target="_blank">
    <i style="font-size: 40px; margin-top:10px;" class="fa fa-whatsapp" aria-hidden="true"></i>
  </a> 

<!-- <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>  -->

  <script src="https://kit.fontawesome.com/5a13b5fda8.js" crossorigin="anonymous"></script>

  <!-- Latest jQuery -->
  <script src="{{asset('assets/js/jquery-1.12.4.min.js')}}"></script>
  <!-- popper min js -->
  <script src="{{asset('assets/js/popper.min.js')}}"></script>
  <!-- Latest compiled and minified Bootstrap -->
  <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- owl-carousel min js  -->
  <script src="{{asset('assets/owlcarousel/js/owl.carousel.min.js')}}"></script>
  <!-- magnific-popup min js  -->
  <script src="{{asset('assets/js/magnific-popup.min.js')}}"></script>
  <!-- waypoints min js  -->
  <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
  <!-- parallax js  -->
  <script src="{{asset('assets/js/parallax.js')}}"></script>
  <!-- countdown js  -->
  <script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
  <!-- imagesloaded js -->
  <script src="{{asset('assets/js/imagesloaded.pkgd.min.js')}}"></script>
  <!-- isotope min js -->
  <script src="{{asset('assets/js/isotope.min.js')}}"></script>
  <!-- jquery.dd.min js -->
  <script src="{{asset('assets/js/jquery.dd.min.js')}}"></script>
  <!-- slick js -->
  <script src="{{asset('assets/js/slick.min.js')}}"></script>
  <!-- elevatezoom js -->
  <script src="{{asset('assets/js/jquery.elevatezoom.js')}}"></script>
  <!-- scripts js -->
  <script src="{{asset('assets/js/scripts.js')}}"></script>
  
  <script>
    // $(document).ready(function() {
    //     $('#modalOff').click(function() {
    //         if ($(this).is(":checked")){
    //             $.get('disableModal',function(){
    //                 // alert('si')
    //             })
    //         } else {
    //             // alert('no')
    //         }
    //     });
    // });
</script>
  @stack('script')

  </body>
</html>
