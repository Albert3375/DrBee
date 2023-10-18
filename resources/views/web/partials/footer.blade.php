<!-- START FOOTER -->
<footer class="footer_dark">
  <div class="footer_top">
        <div class="container">
            <div class="row" >
                <div class="col-lg-4 col-md-4 col-sm-4" style="text-align: center">
                    <div class="widget">
                        <h6 class="widget_title">@lang('footer.info')</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>Imprenta 205 Locales 10 y 11. , Col. Morelos, Alcaldia Venustiano Carranza, Ciudad de Mexico, Mexico. C.P. 15270.</a></p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:ventas@xoofish.com.mx">ventas@zoofish.com.mx</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p><a href="tel:+52 5579429702">(+52) 55 7942 9702 </a> <br> <a href="tel:+525579429702"></p>
                            </li>
                        </ul>
                    </div>
                    <div class="widget">
                        <ul class="social_icons rounded_social">
                            <li style="margin: 0 30px"><a target="_blank" href="" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                            <li style="margin: 0 30px"><a target="_blank" href="" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4" style="text-align: center">
                  <div class="widget">
                        <h6 class="widget_title">@lang('footer.browse')</h6>
                        <ul class="widget_links">
                            <li><a href="{{ url('/')}}">Inicio</a></li>
                            <!-- <li><a href="{{ url('/express_purchase')}}">Compra Express</a></li> -->
                            <li><a href="{{ url('/products')}}">@lang('footer.products')</a></li>
                            <!-- {{-- <li><a href="#">Ofertas</a></li> --}} -->
                            <li><a href="{{ url('/contact')}}">@lang('footer.contact')</a></li>
                            <!-- <li><a href="{{ url('/outlet')}}">Outlet</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4" style="text-align: center">
                  <div class="widget">
                        <h6 class="widget_title">@lang('footer.account')</h6>
                        <ul class="widget_links">
                            <li><a href="{{ URL('/login') }}">@lang('footer.login')</a></li>
                            <li><a href="{{ URL('/register') }}">@lang('footer.register')</a></li>
                        </ul>
                        <a href="{{ URL('/') }}"><img src="{{ asset('img/zoofish-pets.png') }}" style="width: auto !important; height: auto !important; max-width: 100%; margin-top: 50px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer bg_dark4">
        <div class="container">
            <div class="row">
                <div class="col-md-12" align="center">
                    <p class="mb-md-0 text-center text-md-center" style="font-size: 16px; color:white;">
                      Copyright © <script>document.write(new Date().getFullYear());</script>. Zoofish. @lang('footer.copyright') Made with&nbsp;❤️&nbsp;by <a style="color: #fff" href="https://synapdevs.com" target="_blank">Synapdevs.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->
