@component('mail::message')
# ¡Hola! <br> Zoofish te agradece por suscribrirte a nuestro newsletter {{$name}} .

# Notificaremos al siguiente Correo Electrónico: <br>

Correo:
{{ $email }}
<br>

<br>
<br>
Zoofish.
@endcomponent