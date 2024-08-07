<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
    <style>
        /* Estilos CSS personalizados */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background-color: #2a2a2a;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
        }

        .header {
            background: linear-gradient(45deg, #f3cca3, #e8a87c);
            color: #fff;
            text-align: center;
            padding: 30px 0;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 120px;
            background-color: #1e1e1e;
            padding: 10px;
            border-radius: 50%;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            color: #fff;
            letter-spacing: 1px;
        }

        .content {
            padding: 40px;
        }

        .message {
            background-color: #333;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            position: relative;
        }

        .message::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background-color: #333;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #f3cca3;
            font-size: 24px;
            margin: 0 0 20px;
            border-bottom: 2px solid #e8a87c;
            padding-bottom: 10px;
        }

        p {
            font-size: 18px;
            line-height: 1.8;
            margin: 10px 0;
        }

        .field-label {
            font-weight: bold;
            color: #e8a87c;
        }

        .field-value {
            color: #fff;
        }

        .thank-you {
            text-align: center;
            font-size: 16px;
            color: #e8a87c;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e8a87c;
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="Company Logo">
            <h1>Hola, {{ $datos['name'] }}</h1>
        </div>

        <div class="content">
            <div class="message">
                <h1>Has recibido un nuevo mensaje de contacto</h1>
                <p><span class="field-label">Asunto:</span> <span class="field-value">{{ $datos['subject'] }}</span></p>
                <p><span class="field-label">Correo del remitente:</span> <span class="field-value">{{ $datos['email'] }}</span></p>
                <p><span class="field-label">Mensaje:</span> <span class="field-value">{{ $datos['message'] }}</span></p>
            </div>

            <p class="thank-you">© Copyright LLC 2023.</p>
        </div>
    </div>
</body>
</html>
