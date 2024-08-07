
<style>
    /* Estilos generales del footer */
    footer.footer_dark {
        background-color: #063970;
        color: #fff;
        padding-top: 50px;
    }

    footer.footer_dark .widget_title {
        color: #fff;
        font-size: 18px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    footer.footer_dark ul.contact_info li {
        margin-bottom: 15px;
        list-style: none;
    }

    footer.footer_dark ul.contact_info li i {
        color: #f0c419;
        font-size: 20px;
        margin-right: 10px;
    }

    footer.footer_dark ul.contact_info li a,
    footer.footer_dark ul.contact_info li p {
        color: #ccc;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 0;
    }

    footer.footer_dark ul.social_icons li {
        display: inline-block;
        margin: 0 10px;
    }

    footer.footer_dark ul.social_icons li a {
        color: #fff;
        font-size: 20px;
    }

    /* Estilos para los enlaces en el footer */
    footer.footer_dark .widget_links {
        padding-left: 0;
        list-style: none;
    }

    footer.footer_dark .widget_links li {
        margin-bottom: 10px;
    }

    footer.footer_dark .widget_links li a {
        color: #ccc;
        font-size: 14px;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    footer.footer_dark .widget_links li a:hover {
        color: #f0c419;
    }

    /* Estilos para el pie de página inferior */
    footer.footer_dark .bottom_footer {
        background-color: #111;
        padding: 20px 0;
        margin-top: 30px;
    }

    footer.footer_dark .bottom_footer p {
        font-size: 14px;
        color: #888;
        margin-bottom: 0;
    }

    footer.footer_dark .bottom_footer a {
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    footer.footer_dark .bottom_footer a:hover {
        color: #f0c419;
    }
</style>



<!-- START FOOTER -->
<footer class="footer_dark">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="widget text-center">
                        <h6 class="widget_title">@lang('footer.info')</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                <iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.0732425379175!2d-109.92708708496356!3d22.902419285011135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86af4a5de240df4d%3A0x32f978cd3a983eff!2sC.%20San%20Antonio%2006-LOC%2022%2C%20Arcos%20del%20Sol%20I%2C%2023474%20Cabo%20San%20Lucas%2C%20B.C.S.!5e0!3m2!1ses!2smx!4v1691618478239!5m2!1ses!2smx"
  width="100%"
  height="400"
  style="border:0;"
  allowfullscreen=""
  loading="lazy"
  referrerpolicy="no-referrer-when-downgrade"
></iframe>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:farmaciadrbee@hotmail.com">farmaciadrbee@hotmail.com</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p><a href="tel:+525579429702">+624 143 9856</a></p>
                            </li>
                        </ul>
                        <ul class="social_icons rounded_social">
                            <li><a target="_blank" href="https://www.facebook.com/FARMACIADRBEE?locale=es_LA" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                            <li><a target="_blank" href="https://www.instagram.com/farmaciadrbee/" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="widget text-center">
                        <h6 class="widget_title">@lang('footer.browse')</h6>
                        <ul class="widget_links">
                            <li><a href="{{ url('/') }}">Inicio</a></li>
                            <li><a href="{{ url('/products') }}">@lang('footer.products')</a></li>
                            <li><a href="{{ url('/contact') }}">@lang('footer.contact')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="widget text-center">
                        <h6 class="widget_title">@lang('footer.account')</h6>
                        <ul class="widget_links">
                            <li><a href="{{ url('/login') }}">@lang('footer.login')</a></li>
                            <li><a href="{{ route('register') }}">@lang('footer.register')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- END FOOTER -->
