<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje de Contacto</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #0044CC;
            padding: 20px;
            text-align: center;
            color: #FFDD44;
        }
        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 1.8rem;
            text-transform: uppercase;
        }
        .content {
            padding: 20px;
        }
        .content h3 {
            font-size: 1.4rem;
            color: #0044CC;
            margin-top: 0;
        }
        .content p {
            font-size: 1rem;
            line-height: 1.6;
        }
        .message {
            background-color: #eaf1fb;
            padding: 15px;
            border-left: 4px solid #0044CC;
            margin: 20px 0;
            font-style: italic;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
        .footer a {
            color: #0044CC;
            text-decoration: none;
        }

     
    .logo-img {
        width: 300px; /* Ajusta el tamaño según sea necesario */
        height: auto; /* Mantiene la proporción de la imagen */
        display: block; /* Asegura que la imagen se alinee correctamente */
        margin: 0 auto; /* Centra la imagen en su contenedor */
    }


    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
        <img src="https://i.postimg.cc/zv5qLrSH/dr-bee-2-edited.jpg" alt="Logo" class="logo-img" width="300px">
            <h2>Farmacia Economica Dr.Bee</h2>
        </div>
        <div class="content">
            <h3>Gracias por Contactarnos</h3>
            <p>Hola {{ $data['name'] }},</p>
            <p>Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>
            <div class="message">
                <p><strong>Tu Mensaje:</strong></p>
                <p>{{ $data['message'] }}</p>
            </div>
            <p>Saludos,<br>El equipo de {{ config('app.name') }}</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Farmacia Economica Dr.Bee. Todos los derechos reservados.</p>
            <p>Visítanos en <a href="https://www.tusitioweb.com">www.tusitioweb.com</a></p>
        </div>
    </div>
</body>
</html>
