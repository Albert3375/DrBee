@extends('web.partials.master')

@section('title', 'Contacto')

@section('content')

<section class="section_contact pt-10" style="margin-top: 100px;">
    <div class="section pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-map2"></i>
                        </div>
                        <div class="contact_text">
                            <h6>
                                @lang('contact.address')
                            </h6>
                            <span>
                                 Imprenta 205 Locales 10 y 11. Col. Morelos, Alcaldia Venustiano Carranza, Ciudad de Mexico, Mexico. C.P. 15270.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-envelope-open"></i>
                        </div>
                        <div class="contact_text">
                            <h6>
                                @lang('contact.mail')
                            </h6>
                            <br>
                            <span><a href="mailto:ventas@zoofish.com.mx">ventas@zoofish.com.mx</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-tablet2"></i>
                        </div>
                        <div class="contact_text">
                            <h6>
                                @lang('contact.phone')
                            </h6>
                            <a href="tel:+52 5579429702">(+52) 55 7942 9702</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
<div class="section pt-1">
	<div class="container">
    	<div class="row">
        	<div class="col-md-6" align="center">
            	<div class="heading_s1">
                	<h2>
                        @lang('contact.question')
                    </h2>
                </div>
                <p class="leads">
                    <!-- @lang('contact.help') -->
                    Deseas obtener mas información para la compra de artículos y peces al mayoreo con nosotros , o simplemente darnos una sugerencia o comentario, por favor llena el formulario que se muestra a continuación.
                </p>
                <div class="row mt-5">
              <div class="col-lg-8 mt-5 mt-lg-0">
                  <form id="contact-form" action="{{ route('contact.send') }}" method="post" role="form" class="php-email-form">
                      @csrf
                     
                      <div class="row">
                            <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Tu Nombre" required>
                             </div>
                            <div class="form-group col-md-6">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Tu correo" required>
                            </div>
                       
                            <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujeto" required>
                            </div>
                            <div class="form-group col-md-12">
                            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Mensaje" required></textarea>
                            </div>

                        <div class="my-3">
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                      <div class="text-center"><button type="submit" class="btn btn-fill-out"    >Send Message</button></div>
                  </form>
                  <div id="success-message" class="text-success" style="display: none;"></div>
                  <div id="error-message" class="text-danger" style="display: none;"></div>
              </div>
          </div>
      </div>
  </section>

  <script>
      // Escucha el evento de envío del formulario
      document.getElementById('contact-form').addEventListener('submit', function (e) {
          e.preventDefault();

          // Obtiene los datos del formulario
          var formData = new FormData(this);

          // Realiza una solicitud Ajax para enviar el formulario
          fetch('{{ route('contact.send') }}', {
              method: 'POST',
              body: formData
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  // Muestra el mensaje de éxito
                  document.getElementById('success-message').textContent = 'Tu mensaje ha sido enviado correctamente. Gracias por ponerte en contacto con nosotros.';
                  document.getElementById('success-message').style.display = 'block';
                  document.getElementById('error-message').style.display = 'none';

                  // Limpia los campos del formulario
                  document.getElementById('name').value = '';
                  document.getElementById('email').value = '';
                  document.getElementById('subject').value = '';
                  document.getElementById('message').value = '';
              } else {
                  // Muestra el mensaje de error
                  document.getElementById('error-message').textContent = 'Error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.';
                  document.getElementById('error-message').style.display = 'block';
                  document.getElementById('success-message').style.display = 'none';
              }
          })
          .catch(error => {
              console.error('Error:', error);
              // Muestra el mensaje de error en caso de error en la solicitud
              document.getElementById('error-message').textContent = 'Error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.';
              document.getElementById('error-message').style.display = 'block';
              document.getElementById('success-message').style.display = 'none';
          });
      });
  </script>
            <div class="col-md-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
                <iframe loading="lazy" src="https://maps.google.com/maps?q=zoofish&amp;t=m&amp;z=14&amp;output=embed&amp;iwloc=near" title="zoofish" aria-label="zoofish" width="600" height="450" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</div>

                

@push('script')

@endpush

@endsection
