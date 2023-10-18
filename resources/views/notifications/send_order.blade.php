@component('mail::message')
# ¡Hola! <br> Muchas gracias por comprar en Zoofish, te enviamos el detalle de tu orden en un archivo adjunto.

# El archivo se encuentra adjunto y se envió a la siguiente dirección de correo: <br>

Correo electrónico de destino:
<br>
@empty($user['email'])
{{ $email }}
@else
{{ $user['email'] }}
@endempty
<br>
<br>
Zoofish.

@endcomponent
