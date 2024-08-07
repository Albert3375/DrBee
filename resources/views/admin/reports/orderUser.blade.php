<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden de Compra - #{{$order->id}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #ff9300;
            --success-color: #28a745;
            --text-color: #333;
            --font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-family);
            color: var(--text-color);
            font-size: 14px;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container-fluid {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .header-img {
            max-width: 120px;
        }

        .header-text-right {
            text-align: right;
        }

        h2 {
            font-size: 24px;
            color: var(--secondary-color);
        }

        h3 {
            font-size: 20px;
            color: var(--success-color);
        }

        h5 {
            font-size: 14px;
            color: #555;
        }

        .highlight {
            color: var(--secondary-color);
            font-weight: bold;
        }

        .section-title {
            font-size: 16px;
            color: var(--primary-color);
            margin-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
        }

        .sp-subtitle {
            font-size: 13px;
            margin-bottom: 5px;
            color: #555;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 14px;
            border-collapse: collapse;
        }

        .table thead {
            background: var(--primary-color);
            color: #fff;
        }

        .table td, .table th {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }

        .summary-table th, .summary-table td {
            border: none;
            font-size: 14px;
        }

        .contact-info {
            margin-top: 20px;
            font-size: 12px;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .footer-text {
            text-align: right;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .btn {
            font-size: 14px;
            margin: 5px;
            padding: 10px 20px;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #cc7a00;
            border-color: #cc7a00;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="img/zoofish-pets.png" class="header-img" alt="Logo">
            </div>
            <div class="col-md-6 header-text-right">
                <h2>Número de pedido: <span class="highlight">#{{$order->id}}</span></h2>
                <h5>{{$order->created_at}}</h5>
            </div>
        </div>
        <div class="row text-center mt-3">
            <div class="col-md-12">
                <h5>EN CASO DE REQUERIR FACTURA SOLICITARLA</h5>
                <h3>TOTAL DE LA COMPRA: ${{ number_format($order->total, 2) }}</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <p class="section-title">Dirección del pedido</p>
                <p class="sp-subtitle"><b>Dirección:</b> {{ $address->street }}</p>
                <p class="sp-subtitle"><b>N°:</b> #{{ $address->numberExt }}</p>
                <p class="sp-subtitle"><b>C.P:</b> {{$address->postalCode}}</p>
                <p class="sp-subtitle"><b>Colonia:</b> {{$address->col}}</p>
                <p class="sp-subtitle"><b>Municipio:</b> {{$address->municipality}}</p>
            </div>
            <div class="col-md-6">
                <p class="section-title">Datos del cliente</p>
                <p class="sp-subtitle"><b>Nombre:</b> {{$user->name}} {{$user->surname}}</p>
                <p class="sp-subtitle"><b>Correo:</b> {{$user->email}}</p>
                <p class="sp-subtitle"><b>Teléfono:</b> {{$user->phone}}</p>
                <p class="sp-subtitle"><b>Estado:</b> {{$address->state}}</p>
                <p class="sp-subtitle"><b>País:</b> {{$address->country}}</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <p class="section-title">Productos del pedido</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Modelo</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Descuento</th>
                            <th>Reexpedición</th>
                            <th>Total Neto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($order->products) as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>$ {{ number_format($product->price, 2) }}</td>
                            @php
                            $subtotal = $order->total - $product->discount;
                            @endphp
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>-${{ number_format($product->discount, 2) }}</td>
                            <td>$0.00</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <p class="section-title">Resumen del pedido</p>
                <table class="table summary-table">
                    <tbody>
                        <tr>
                            <th colspan="3"># del Pedido</th>
                            <td class="highlight">#{{$order->id}}</td>
                        </tr>
                        <tr>
                            <th colspan="3">Dirección de entrega</th>
                            <td class="highlight">{{$order->address->title}}</td>
                        </tr>
                        <tr>
                            <th colspan="3">Fecha del pedido</th>
                            <td class="highlight">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th colspan="3">Estatus del pedido</th>
                            <td class="highlight">{!! $status[$order->status_pay] !!}</td>
                        </tr>
                        <tr>
                            <th colspan="3">Método de pago</th>
                            <td class="highlight">{{ $order->payment_method }}</td>
                        </tr>
                        <tr>
                            <th colspan="3">Total del Pedido</th>
                            <td class="highlight">$ {{ number_format($order->total, 2) }}</td>
                        </tr>
                        {!! Form::hidden('id', $order->id, ['id'=>'id']) !!}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <p class="section-title">Dirección del Pedido</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Calle y Número</th>
                            <th>Colonia</th>
                            <th>Municipio</th>
                            <th>Estado</th>
                            <th>País</th>
                            <th>C.P.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$address->title}}</td>
                            <td>{{ $address->street }} #{{ $address->numberExt }}</td>
                            <td>{{$address->col}}</td>
                            <td>{{$address->municipality}}</td>
                            <td>{{$address->state}}</td>
                            <td>{{$address->country}}</td>
                            <td>{{$address->postalCode}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row contact-info">
            <div class="col-md-6">
                <p class="section-title">Contacto</p>
                <p class="sp-subtitle"><i class="fas fa-envelope"></i> ventas@zoofish.com.mx</p>
                <p class="sp-subtitle"><i class="fas fa-map-marker-alt"></i> Imprenta 205 Locales 10 y 11.</p>
                <p class="sp-subtitle">Col. Morelos, Alcaldia Venustiano Carranza.</p>
                <p class="sp-subtitle">Ciudad de Mexico, Mexico. C.P. 15270.</p>
            </div>
            <div class="col-md-6 footer-text">
                @php
                $now = \Carbon\Carbon::now();
                @endphp
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Zoofish Pets. Todos los derechos reservados.</p>
    </footer>

    @push('script')
    <script>
        $(document).ready(function() {
            $('#table-orders').DataTable({
                "language": {
                    "url": @json(App::isLocale('es') ? "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json" : "//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json")
                },
                "responsive": true,
                "bSort": false,
                "buttons": ['csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
    @endpush
</body>
</html>
