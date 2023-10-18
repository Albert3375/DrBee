@component('mail::message')
# ¡Hola! <br> Muchas gracias por comprar en Zoofish, a continuación te compartimos los detalles de tu compra.

# Los detalles: <br>

Nombre:
<br>
@empty($user['name'])
{{ $name }}
@else
{{ $user['name'] }}
@endempty
<br>
Teléfono:
<br>
@empty($user['phone'])
{{ $phone }}
@else
{{ $user['phone'] }}
@endempty
<br>
Correo:
@empty($user['email'])
{{ $email }}
@else
{{ $user['email'] }}
@endempty
<br>
Dirección de entrega:
@empty($user['billing_address'])
{{ $billing_address }}
@else
{{ $user['billing_address'] }}
@endempty
<br>
C.P.
@empty($user['zipcode'])
{{$zipcode}}
@else
{{ $user['zipcode'] }}.
@endempty
<br>
{{-- # Productos:
 @foreach($products as $product)
  Nombre del producto:
  <br>
  {{$product->name}}
  <br>
  Precio:
  <br>
  ${{$product->price}}
  <br>
  <br>
  <img src="{{ URL($product->image) }}" alt="Zoofish" style="width: auto !important; height: auto !important; max-width: 25%;">
  <br>
  <br>
@endforeach --}}

Total:
${{ $total }}
<br>
<br>
Envía tu comprobante de pago.
<br>
BBVA Cuenta Principal
<br>
Tarjeta:
<br>
4152-3136-5573-9352
<br>
<br> 
BBVA Cuenta Fiscal
<br>
Tarjeta:
<br>
4152-3137-7857-6350
<br>
<br>
CITIBANAMEX
<br>
Tarjeta:
<br>
5204-1649-0800-7096
<br>
<br>
Notificar tu pago al correo: ventas@zoofish.com.mx
<br>
O escríbenos al WhatsApp 
<br>
<a href="https://api.whatsapp.com/send?phone=+525579429702&text=Hola%21%20quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Zoofish%20😊❤️." target="_blank">
<i style="font-size: 38px; margin-top:10px;" class="fa fa-whatsapp" aria-hidden="true"></i>
(+52) 55 7942 9702
</a>
<br>
# Solucionaremos tus dudas. Estamos para ayudarte.
<br>
Horario de atención: 
<br>
Lunes a Viernes - 10:00 am a 7:00 pm 
Sábados - 10:00 am a 2:00 pm
<br>
<br>
Zoofish.

@endcomponent
