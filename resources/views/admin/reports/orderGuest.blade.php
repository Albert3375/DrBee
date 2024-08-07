<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden de Compra - #{{$order->id}}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        @page {
            margin: 2cm;
        }
        @media print {
            body {
                margin: 1cm;
            }
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border: 1px solid #ddd;
        }

        .header-logo img {
            max-width: 60%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-details {
            margin-top: -60px;
            text-align: right;
        }

        h2 {
            color: #007bff;
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        h3 {
            color: #28a745;
            font-size: 28px;
            font-weight: 600;
        }

        p {
            line-height: 1.8;
            font-size: 16px;
            margin: 10px 0;
        }

        .table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .table thead {
            background-color: #007bff;
            color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #e2e6ea;
        }

        .table tfoot {
            background-color: #f1f3f5;
            font-weight: 700;
        }

        .text-primary {
            color: #007bff !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .font-weight-bold {
            font-weight: 700;
        }

        .footer-contact p {
            font-size: 14px;
            margin: 5px 0;
        }

        .footer-contact p a {
            color: #007bff;
            text-decoration: none;
        }

        .footer-contact p a:hover {
            text-decoration: underline;
        }

        .sp-header {
            margin-bottom: 20px;
        }

        .sp-header-text-order {
            margin: auto;
        }

        .sp-title {
            font-size: 20px;
            color: #007bff;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .sp-subtitle {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }

        .highlight {
            color: #ff9300;
            font-weight: 600;
        }

        .row::after {
            content: "";
            display: table;
            clear: both;
        }

        .footer-logo img {
            max-width: 80%;
            height: auto;
            margin-top: 10px;
        }

        .footer-contact {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row sp-header">
        <div class="col-md-5 header-logo">
            <img src="img/zoofish-pets.png" alt="Logo">
        </div>
        <div class="col-md-7 header-details">
            <h2>Orden de Compra: <span class="highlight">#{{$order->id}}</span></h2>
            @php
            $now = \Carbon\Carbon::now();
            @endphp
            <h5>{{$order->created_at}}</h5>
        </div>
        <div class="col-md-12 text-center">
            <h5>EN CASO DE REQUERIR <br> FACTURA SOLICITARLA</h5>
            <h3 class="text-success">TOTAL DE LA COMPRA: </h3>
            <h3>${{ number_format($order->total,2)}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <p class="sp-title">Dirección del pedido</p>
            <p><b>Dirección:</b> {{$order->billing_address}}</p>
            <p><b>Ciudad:</b> {{$order->city}}</p>
            <p><b>C.P:</b> {{$order->zipcode}}</p>
        </div>
        <div class="col-md-7">
            <p class="sp-title">Datos del cliente</p>
            <p><b>Nombre:</b> {{$order->fname}} {{$order->lname}}</p>
            <p><b>Correo:</b> {{$order->email}}</p>
            <p><b>Teléfono:</b> {{$order->phone}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <p class="sp-title">Productos del pedido</p>
            <table id="table-orders" class="table table-striped">
                <thead>
                    <tr>
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
                    $totalPiezas += $product->quantity;
                    @endphp
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->discount}}</td>
                        <td>${{ number_format($product->price,2)}} MXN</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <p class="sp-title">Resumen del pedido</p>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Total productos</th>
                        <td>{{ count($products) }} Productos</td>
                    </tr>
                    <tr>
                        <th>Total piezas</th>
                        <td>{{ $totalPiezas }} Piezas</td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td>${{ number_format($order->total, 2) }} MXN</td>
                    </tr>
                    <tr>
                        <th>Envío</th>
                        <td>Envío gratuito</td>
                    </tr>
                    <tr>
                        <th>Método de pago</th>
                        <td>{{$order->payment_method}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row footer-contact">
        <div class="col-md-6">
            <p class="sp-title">Contacto</p>
            <p><a href="mailto:ventas@zoofish.com.mx">ventas@zoofish.com.mx</a></p>
            <p>Imprenta 205 Locales 10 y 11.</p>
            <p>Col. Morelos, Alcaldía Venustiano Carranza.</p>
            <p>Ciudad de México, México. C.P. 15270.</p>
        </div>
        <div class="col-md-6 text-right">
            @php
            $now = \Carbon\Carbon::now();
            @endphp
            <p>Fecha de impresión: {{$now}}</p>
        </div>
    </div>
</div>

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table-orders').DataTable({
            "language": {
                "url": "{{ App::isLocale('es') ? '//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json' : '//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json' }}"
            },
            "responsive": true,
            "bSort": false,
            "dom": 'Bfrtip',
            "buttons": ['csv', 'excel', 'pdf', 'print']
        });
    });
</script>
@endpush

</body>
</html>
