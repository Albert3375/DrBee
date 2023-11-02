<!DOCTYPE html>
<html>
<head>
    <title>Agradecimiento por Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #4A00E0, #7D00D0);
            background-size: 400% 400%;
            animation: gradient 5s infinite;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 600px;
            position: relative;
        }
        h1 {
            font-size: 30px;
            margin: 0 0 20px;
            color: #4A00E0;
        }
        p {
            font-size: 18px;
            margin: 0 0 15px;
        }
        .logo {
            width: 100px;
            display: block;
            margin: 0 auto 20px;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Agrega una animación de pulsación al mensaje de agradecimiento */
        .thank-you {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Estilo adicional para el botón */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4A00E0;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            text-decoration: none;
            margin-top: 20px;
        }

        /* Animación de resaltado para el botón */
        .button:hover {
            background-color: #7D00D0;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('img/logo.png') }}" class="logo">
        <h1>¡Gracias por tu mensaje!</h1>
        <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Asunto:</strong> {{ $data['subject'] }}</p>
        <p><strong>Mensaje:</strong> {{ $data['message'] }}</p>
        <!-- Aplica la clase "thank-you" al mensaje de agradecimiento -->
        <p class="thank-you">Hemos recibido tu mensaje y te responderemos pronto.</p>
        <!-- Agrega un botón para redirigir a tu sitio web o a otra página -->
        
    </div>
</body>
</html>
