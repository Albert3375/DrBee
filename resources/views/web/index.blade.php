@extends('web.partials.master')

@section('title', 'Inicio')

@section('popup')
    @if(session('key') == null)
        @include('web.partials.newsletter_modal')
    @endif
@endsection

@section('content')
    <!-- Librerías CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.10-0/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Estilos Personalizados -->
    <style>
        /* Estilos Globales */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #FFDD44; /* Amarillo */
            color: #0044CC; /* Azul */
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h2, h3 {
            text-transform: uppercase;
            color: #0044CC; /* Azul */
        }

        a {
            color: #0044CC; /* Azul */
            text-decoration: none;
        }

        a:hover {
            color: #002288; /* Un azul más oscuro */
        }

        /* Estilos del Carrusel */
        .owl-carousel .item {
            position: relative;
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .carousel-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #FFDD44; /* Amarillo */
        }

        .carousel-content h2 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .carousel-content p {
            font-size: 1.6rem;
            margin-bottom: 30px;
        }

        .carousel-content a {
            display: inline-block;
            padding: 15px 30px;
            background-color: #0044CC; /* Azul */
            color: #FFDD44; /* Amarillo */
            font-size: 1.4rem;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
        }

        .carousel-content a:hover {
            background-color: #063970; /* Un azul más oscuro */
            transform: scale(1.05);
        }

        /* Sección de Productos */
        .product-section {
            padding: 50px 0;
            background-color: #FFDD44; /* Amarillo */
            text-align: center;
        }

        .product-section h2 {
            margin-bottom: 30px;
        }

        .product-content {
            padding: 30px;
            background-color: #063970; /* Azul */
            color: #FFDD44; /* Amarillo */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            margin: 20px 0;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
        }

        .product-content img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-content h3 {
            color: #FFDD44; /* Amarillo */
            margin-top: 15px;
        }

        /* Sección de Información Detallada */
        .info-section {
            padding: 50px 0;
            background-color: #063970; /* Azul */
            color: #FFDD44; /* Amarillo */
            text-align: center;
        }

        .info-section h2 {
            margin-bottom: 30px;
        }

        .info-content {
            padding: 30px;
            background-color: #FFDD44; /* Amarillo */
            color: #063970; /* Azul */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            margin: 20px 0;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: left;
        }

        .info-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
        }

        /* Sección de Contacto */
        .contact-section {
            padding: 50px 0;
            background-color: #063970; /* Azul */
        }

        .contact-wrap {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            color: #FFDD44; /* Amarillo */
        }

        .contact-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 5rem;
            height: 5rem;
            border-radius: 100%;
            font-size: 2.5rem;
            color: #FFDD44; /* Amarillo */
            background-color: #063970; /* Azul */
        }

        .contact-text h6 {
            margin: 0;
            font-size: 1.4rem;
            color: #FFDD44; /* Amarillo */
        }

        .contact-text span, .contact-text a {
            font-size: 1.2rem;
            color: #FFDD44; /* Amarillo */
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            background-color: #FFDD44; /* Amarillo */
            color: #063970; /* Azul */
            border-radius: 8px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contact-form button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #063970; /* Azul */
            color: #FFDD44; /* Amarillo */
            font-size: 1.4rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, transform 0.3s;
        }

        .contact-form button:hover {
            background-color: #002288; /* Un azul más oscuro */
            transform: scale(1.05);
        }

        /* Estilos del Pie de Página */
        .footer-section {
            padding: 30px 0;
            background-color: #063970; /* Azul */
            text-align: center;
            color: #FFDD44; /* Amarillo */
        }

        .footer-section .social-links a {
            color: #FFDD44; /* Amarillo */
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .footer-section .social-links a:hover {
            color: #002288; /* Un azul más oscuro */
        }
    </style>

    <main>
        <!-- Carrusel -->
        <div class="owl-carousel owl-theme">
            <div class="item" style="background-image: url('https://i.postimg.cc/HsS0v9V4/importancia.jpg');">
                <div class="carousel-content">
                    <h2>Bienvenido a Nuestra Farmacia</h2>
                    <p>Donde el cuidado de su salud es nuestra prioridad.</p>
                    <a href="#about">Conócenos Más</a>
                </div>
            </div>
            <div class="item" style="background-image: url('https://images.pexels.com/photos/16043571/pexels-photo-16043571/free-photo-of-edificio-moderno-calle-ciudad-via.jpeg');">
                <div class="carousel-content">
                    <h2>Productos de Calidad</h2>
                    <p>Ofrecemos una amplia variedad de productos de salud y bienestar.</p>
                    <a href="#features">Descubre Más</a>
                </div>
            </div>
            <div class="item" style="background-image: url('https://images.pexels.com/photos/16043575/pexels-photo-16043575/free-photo-of-ventanas-puertas-edificio-negocios.jpeg');">
                <div class="carousel-content">
                    <h2>Atención Personalizada</h2>
                    <p>Estamos aquí para ayudarte en cada paso del camino hacia una mejor salud.</p>
                    <a href="#contact">Contáctanos</a>
                </div>
            </div>
        </div>

        <!-- Sección de Productos -->
        <section class="product-section" id="features">
            <div class="container">
                <h2>Productos Destacados</h2>
                <div class="row">
                    <!-- Producto 1 -->
                    <div class="col-md-4">
                        <div class="product-content" data-aos="fade-up">
                            <img src="https://i.postimg.cc/59sh4WNm/ortopedia.jpg" alt="Producto de Ortopedia">
                            <h3>Productos de Ortopedia</h3>
                            <p>Ofrecemos una amplia gama de productos de ortopedia para ayudar a mejorar su movilidad y calidad de vida. Descubra nuestra selección de muletas, rodilleras, sillas de ruedas y más.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                        </div>
                    </div>
                    <!-- Producto 2 -->
                    <div class="col-md-4">
                        <div class="product-content" data-aos="fade-up" data-aos-delay="100">
                            <img src="https://i.postimg.cc/ZYdh5Wxm/medi.jpg" alt="Medicamentos">
                            <h3>Medicamentos</h3>
                            <p>Nuestra farmacia ofrece una variedad de medicamentos para diversas condiciones. Nuestro personal capacitado está aquí para brindarle asesoramiento experto y ayudarle a encontrar lo que necesita.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                        </div>
                    </div>
                    <!-- Producto 3 -->
                    <div class="col-md-4">
    <div class="product-content" data-aos="fade-up" data-aos-delay="200">
        <img src="https://i.postimg.cc/fT4Pb58W/24.jpg" alt="Enfermedades">
        <h3>Servicio 24 Horas</h3>
        <p>Estamos disponibles las 24 horas del día para ofrecerle información y productos necesarios para el manejo y tratamiento de diversas enfermedades. Nuestro equipo está aquí para guiarlo en la gestión de su salud, en cualquier momento.</p>
        <a href="#" class="btn btn-primary">Ver Más</a>
    </div>
</div>

                </div>
            </div>
        </section>

        <!-- Sección de Información Detallada -->
        <section class="info-section" id="about">
            <div class="container">
                <h2>Sobre Nosotros</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-content" data-aos="fade-right">
                            <h3>Nuestra Misión</h3>
                            <p>Nuestra misión es brindar un servicio excepcional a nuestros clientes, ofreciendo productos de alta calidad y asesoramiento profesional para ayudarles a alcanzar sus objetivos de salud y bienestar.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-content" data-aos="fade-left">
                            <h3>Nuestra Visión</h3>
                            <p>Nos esforzamos por ser la farmacia líder en atención al cliente, confiabilidad y accesibilidad, contribuyendo a la salud de nuestras comunidades y mejorando la calidad de vida de las personas a las que servimos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      <!-- Contacto -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2>Contáctanos</h2>
        <div class="row">
            <div class="col-md-6 contact-wrap" data-aos="fade-right">
                <div class="contact-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="contact-text">
                    <h6>Llámanos</h6>
                    <span>+624 143 9856</span>
                </div>
            </div>
            <div class="col-md-6 contact-wrap" data-aos="fade-left">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-text">
                    <h6>Escríbenos</h6>
                    <a href="mailto:farmaciadrbee@hotmail.com">farmaciadrbee@hotmail.com</a>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.send') }}" class="contact-form" data-aos="fade-up" data-aos-delay="200">
    @csrf
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo Electrónico" required>
    <textarea name="message" rows="4" placeholder="Mensaje" required></textarea>
    <button type="submit">Enviar Mensaje</button>
</form>

    </div>
</section>


   
    </main>

    <!-- Scripts JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                items: 1
            });
            AOS.init();
        });
    </script>
@endsection
