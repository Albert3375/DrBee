
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
        /* Estilos generales */
        body.light-mode {
            background: #f8f9fa;
            color: #333;
        }

        body.dark-mode {
            background: #333;
            color: #f8f9fa;
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

        .btn-primary {
            background: #007BFF;
            border: none;
            border-radius: 4px;
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
<div class="container">
    <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        @include('flash::message')
      </div>
      
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <strong>@lang('panel.category')</strong> </div>
          <div class="card-body">
       <!-- Botón de cambio de modo fuera del formulario -->
       <label class="mode-switch" onclick="toggleMode()">
                        <div class="mode-switch-slider"></div>
                    </label>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input" required>@lang('panel.name')</label>
              <div class="col-md-9">
                <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $category->name : '' }}" name="name">
              </div>
            </div>

    

          {{--   <div class="form-group row">
              <label class="col-md-3 col-form-label" for="img">Imagen del Producto M&aacute;x. 2MB</label>
              <div class="col-md-9">
                  <input class="form-control" type="file" name="img"/>
              </div>
            </div> --}}

           

  {{--          <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">Detalles</label>
              <div class="col-md-9">
                <textarea class="form-control"  type="text" value="{{ $method == 'EDIT' ? $product->details : '' }}" name="details" rows="8" cols="80">{{ $method == 'EDIT' ? $product->details : '' }}</textarea>

              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Inventario</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $product->stock : '' }}" name="stock">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="category_id">Categoria</label>
                <div class="col-md-9">
                  <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div> --}}


            @php
              $now = Carbon\Carbon::now();
              $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
            @endphp

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.register_date')</label>
              <div class="col-md-9">
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $category->created_at : $date_formated }}" name="created_at" readonly>
              </div>
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