<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Orden</title>
</head>
<body>
    <h1>Gracias por tu compra, {{ $order->fname }}!</h1>
    <p>Hemos recibido tu pedido. A continuación se muestran los detalles:</p>

    <p><strong>Orden No:</strong> {{ $order->id }}</p>
    <p><strong>Total:</strong> {{ $order->total }}</p>

    <h2>Productos</h2>
    <ul>
        @foreach($products as $product)
            <li>{{ $product->name }} - Cantidad: {{ $product->quantity }} - Precio: {{ $product->price }}</li>
        @endforeach
    </ul>
</body>
</html>
