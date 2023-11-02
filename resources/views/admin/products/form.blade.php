<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* Estilos generales */
    body.light-mode {
        background: #f8f9fa;
        color: #333;
    }

    body.dark-mode {
        background: #333;
        color: #fff; /* Cambiamos el color del texto a blanco en modo oscuro */
    }

    .container {
        margin-top: 30px;
    }

    .card {
        border: none;
        background-color: transparent;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background: #007BFF;
        color: #fff;
        text-align: center;
        padding: 15px 0;
        border-radius: 8px 8px 0 0;
    }

    .form-group label {
        font-weight: bold;
        color: #007BFF;
    }

    .form-control {
        border: 1px solid #007BFF;
        border-radius: 4px;
        background-color: transparent;
        color: #333;
    }

    .form-control:focus {
        border-color: #007BFF;
        background-color: transparent;
        color: #333;
    }

    .form-control::placeholder {
        color: #fff; /* Cambiamos el color del texto del marcador de posición a blanco en modo oscuro */
    }

    .btn-primary {
        background: #007BFF;
        border: none;
        border-radius: 4px;
        color: #fff; /* Cambiamos el color del texto a blanco en modo oscuro */
    }

    .btn-primary:hover {
        background: #0056b3;
    }

    /* Estilos adicionales para hacer que el formulario sea más atractivo */
    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    textarea {
        resize: vertical;
        background-color: transparent;
        color: #333;
    }

    textarea::placeholder {
        color: #fff; /* Cambiamos el color del texto del marcador de posición a blanco en modo oscuro */
    }

    img {
        max-width: 100%;
    }

    /* Switch para cambiar el modo */
    .mode-switch {
        position: absolute;
        top: 10px;
        left: 10px;
        display: inline-block;
        width: 50px;
        height: 26px;
        background: #ccc;
        border-radius: 26px;
        cursor: pointer;
    }

    .mode-switch-slider {
        position: absolute;
        top: 1px;
        left: 1px;
        width: 24px;
        height: 24px;
        background: #fff;
        border-radius: 50%;
        transition: 0.2s;
    }

    .dark-mode .mode-switch-slider {
        left: 25px;
    }
</style>


</head>
<body class="light-mode">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- Botón de cambio de modo fuera del formulario -->
                    <label class="mode-switch" onclick="toggleMode()">
                        <div class="mode-switch-slider"></div>
                    </label>
                    <div class="card-header">
                        <h3>Registro Productos</h3>
                    </div>
                    <div class="card-body">
                       
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" value="{{ $method == 'EDIT' ? $product->name : '' }}" name="name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">Precio</label>
                                    <input type="number" class="form-control" min="0" step="0.01" id="price" value="{{ $method == 'EDIT' ? $product->price : '' }}" name="price" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea class="form-control" style="resize: vertical" id="description" name="description" rows="5" required>{{ $method == 'EDIT' ? $product->description : '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Imagen del Producto (Máx. 2MB)</label>
                                @if(isset($product->image))
                                    <img src="{{ URL($product->image) }}" class="img-fluid mb-2" alt="Imagen del Producto">
                                @endif
                                <input class="form-control-file" type="file" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="category">Categoría</label>
                                {!! Form::select('category_id', $category, 0, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock de Productos</label>
                                <input type="number" class="form-control" min="0" id="stock" value="{{ $method == 'EDIT' ? $product->stock : '' }}" name="stock" required>
                            </div>
                            <div class="form-group">
                                <label for="clave_sae">Cliente SAE</label>
                                <input type="text" class="form-control" id="clave_sae" value="{{ old('clave_sae') }}" name="clave_sae" required>
                            </div>
                            @php
                                $now = Carbon\Carbon::now();
                                $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
                            @endphp
                            <div class="form-group">
                                <label for="created_at">Fecha de Registro</label>
                                <input type="text" class="form-control" id="created_at" value="{{ $method == 'EDIT' ? $product->created_at : $date_formated }}" name="created_at" readonly>
                            </div>
                           
                
             
          </div>
        </div>
        </div>

        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Función para alternar entre modos claro y oscuro
        function toggleMode() {
            const body = document.body;
            body.classList.toggle("light-mode");
            body.classList.toggle("dark-mode");
        }
    </script>
</body>
</html>