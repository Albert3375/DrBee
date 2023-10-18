<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden de Compra - #{{$order->id}}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel=" stylesheet">
</head>

<style>
    @page {
        margin-top: 1.5cm;
        margin-bottom: 1.5cm;
        margin-left: 1.5cm;
        margin-right: 1.5cm;
    }
    @media print {
        body {margin-top: 0.5mm; margin-bottom: 0.5mm;
            margin-left: 0.5mm; margin-right: 0.5mm}
        }
        div .attendance{
            border: 1px solid;
            font-family: 'Poppins'; 
        }
        p{
            line-height: 95%;
            font-size: 20px;
            font-family: 'Poppins'; 
        }
        h2{
            line-height: 60%;
            font-family: 'Poppins'; 
        }
        h3{
            line-height: 60%;
            font-size: 18px;
            font-family: 'Poppins'; 
        }
        h4{
            line-height: 60%;
            font-size: 20px;
            font-family: 'Poppins'; 
        }
        h5{
            line-height: 60%;
            font-size: 18px;
            font-family: 'Poppins'; 
        }
        .text{
            font-family: 'Poppins';
        }
        th, td, tr {
          font-family: 'Poppins';
          padding: 5px;
          font-size: 14px;
          text-align: center;
          border-width: 0.5;
          border-style: solid;
      }

      .text{
/*     font-family: 'Poppins'; */
}
/* th, td, tr {
        padding: 5px;
        font-size: 15px;
        text-align: center;
        border-width: 0.5;
        border-style: solid;
    } */

    .sp-contenedor {
    /* background-color: #D0D3D4;
    max-width: 1000px;
    margin: 15px auto; */
}

.sp-header {
    /* display: flex;
    flex-wrap: wrap; */
}

.sp-img {
    /* width: auto !important; 
    height: auto !important; 
    max-width: 25%; */
}

hr {
    /* margin: 10px; */
}

.sp-header-text-order {
    /* margin: auto;
    display: table; */
}

.sp-header-text {
    /* margin: auto;
    flex: auto;
    padding-left: 15px; */
} 

.sp-header-img {
    /* margin: auto;
    display: contents; */
}

hr {
    margin: 0px;
}

.sp-p {
    margin-bottom: 5px;
}

.table td, .table th {
    padding: 0.0rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    padding-left: 4px;
    font-family: 'Poppins';
}

.sp-title {
    font-size: 16px;
    font-family: 'Poppins';
}

.sp-subtitle {
    font-size: 14px;
    font-family: 'Poppins';
}
</style>

<body style="font-family: 'Poppins';">

 <div class="container-fluid">
    <div class="row">
        <div class="col-md-5" align="left">
            <img src="img/zoofish-pets.png" style="width: auto !important; height: auto !important; max-width: 50%;">
        </div>
        <div class="col-md-7" align="right" style="margin-top: -100px;">
            <!-- <h2>Pedido #{{$order->id}}</h2> -->
            <h2>Número de pedido: <span style="color: #ff9300;"><b>#{{$order->id}}</b></span></h2>
            @php
            $now = \Carbon\Carbon::now();
            @endphp 
            <h5>{{$order->created_at}}</h5>
        </div>
        <div class="col-md-12" align="center">
            <h5>EN CASO DE REQUERIR <br> FACTURA SOLICITARLA</h5>
            <h3 style="color: limegreen;">TOTAL DE LA COMPRA: </h3><h3>${{ number_format($order->total,2)}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5" style="float: right;">
            <p class="sp-p sp-title" style="color: #ff9300;">Dirección del pedido</p>
            <p class="sp-p sp-subtitle"><b>Dirección:</b> {{$order->billing_address}}</p>
            <p class="sp-p sp-subtitle"><b>Ciudad:</b> {{$order->city}}</p>
            <p class="sp-p sp-subtitle"><b>C.P:</b> {{$order->zipcode}}</p>
        </div>
        <div class="col-md-7">
            <p class="sp-p sp-title" style="color: #ff9300;">Datos del cliente</p>
            <p class="sp-p sp-subtitle"><b>Nombre:</b> {{$order->fname}} {{$order->lname}}</p>
            <p class="sp-p sp-subtitle"><b>Correo:</b> {{$order->email}}</p>
            <p class="sp-p sp-subtitle"><b>Teléfono:</b> {{$order->phone}}</p>
        </div>

    </div>

    <!-- Datos de la orden -->
    <div class="row">
        <div class="col-md-12" align="center">
            <p class="sp-p sp-title" style="color: #ff9300;">Productos del pedido</p>
            <table id="table-orders" class="table table-dark" style="width:100%">
                <thead class="thead-dark">
                    <tr class="sp-subtitle">
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Descuento</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $totalPiezas = 0;
                    @endphp
                    @foreach (json_decode($order->products) as $product)
                    @php 
                    $totalPiezas = $totalPiezas + $product->quantity;
                    @endphp
                    <tr class="sp-subtitle">
                        <td>{{$product->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->discount}}</td>
                        <td>${{ number_format($product->price,2)}} MXN</td>
                        <!-- <td><img src="{{ asset($product->img) }}" style="width: 150px !important; height: 150px !important; max-width: 60%"></td>  -->
                    </tr>
                    @endforeach
                        <!-- <tr style="font-size: 12px;">
                            <th style="border: none;" colspan="2"></th>
                            <th style="color: #ff9300;" colspan="2"></th>
                        </tr>
                        <tr style="font-size: 12px;">
                            <th colspan="2">Total productos</th>
                            <th style="color: #ff9300;" colspan="2">{{ count($products) }} Productos</th>
                        </tr>
                        <tr style="font-size: 12px;">
                            <th colspan="2">Total piezas</th>
                            <th style="color: #ff9300;" colspan="2">{{ $totalPiezas }} Piezas</th>
                        </tr>
                        <tr style="font-size: 12px;">
                            <th colspan="2">Subtotal</th>
                            <th style="color: #ff9300;" colspan="2">${{ number_format($order->total, 2) }}</th>
                        </tr>
                        <tr style="font-size: 12px;">
                            <th colspan="2">Envío</th>
                            <th style="color: #ff9300;" colspan="2">Envío gratuito</th>
                        </tr>
                        <tr style="font-size: 12px;">
                            <th colspan="2">Metodo de pago</th>
                            <th style="color: #ff9300;" colspan="2">{{$order->payment_method}}</th>
                        </tr> -->
                        
                    </tbody>
                </table>
            </div>

        </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12" align="center">
            <p class="sp-p sp-title" style="color: #ff9300;">Resumen del pedido</p>
            <table id="table-orders" class="table" style="width:100%;">
                <tbody>
                    <tr class="sp-subtitle">
                        <th colspan="3">Total productos</th>
                        <th style="color: #ff9300; font-weight: 400;" colspan="1">{{ count($products) }} Productos</th>
                    </tr>
                    <tr class="sp-subtitle">
                        <th colspan="3">Total piezas</th>
                        <th style="color: #ff9300; font-weight: 400;" colspan="1">{{ $totalPiezas }} Piezas</th>
                    </tr>
                    <tr class="sp-subtitle">
                        <th colspan="3">Subtotal</th>
                        <th style="color: #ff9300; font-weight: 400;" colspan="1">${{ number_format($order->total, 2) }} MXN</th>
                    </tr>
                    <tr class="sp-subtitle">
                        <th colspan="3">Envío</th>
                        <th style="color: #ff9300; font-weight: 400;" colspan="1">Envío gratuito</th>
                    </tr>
                    <tr class="sp-subtitle">
                        <th colspan="3">Método de pago</th>
                        <th style="color: #ff9300; font-weight: 400;" colspan="1">{{$order->payment_method}}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6" align="left">
            <p class="sp-p sp-title" style="color: #ff9300;">Contacto</p>
            <p class="sp-p sp-subtitle">
                ventas@zoofish.com.mx
            </p>
            <p class="sp-p sp-subtitle">
            Imprenta 205 Locales 10 y 11.</p>
            <p class="sp-p sp-subtitle">Col. Morelos, Alcaldia Venustiano Carranza.</p>
            <p class="sp-p sp-subtitle">Ciudad de Mexico, Mexico. C.P. 15270.</p>
        </div>

        <div class="col-md-6" align="right" style="margin-top: -100px;">
            @php
            $now = \Carbon\Carbon::now();
            @endphp
            <br>
            <br>
            <p class="sp-p sp-subtitle">Fecha de impresión: {{$now}}</p>
        </div>
    </div>
</div>

@push('script')
<script>
     @if(App::isLocale('es'))
     $('#table-orders').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
        },
        "responsive": true,
        "bSort": false,
        "buttons": ['csv', 'excel', 'pdf', 'print']
    });
     @else
     $('#table-orders').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json"
        },
        "responsive": true,
        "bSort": false,
        "buttons": ['csv', 'excel', 'pdf', 'print']
    });
     @endif
</script>
@endpush
</body>
</html>