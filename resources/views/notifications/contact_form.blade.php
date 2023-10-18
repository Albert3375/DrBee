@component('mail::message')
# ¡Hola! <br> Recibiste un mensaje a través del formulario de contacto.

# Los detalles: <br>

Nombre:
{{ $name }}
<br>
Teléfono:
{{ $phone }}
<br>
Correo:
{{ $email }}
<br>
Asunto:
{{ $subject }}
<br>
Mensaje:
{{ $message }}
<br>

<br>
<br>
Zoofish.
@endcomponent