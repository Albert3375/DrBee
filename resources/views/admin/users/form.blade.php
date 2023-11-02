<!-- Incluye jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluye Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />

<!-- Incluye Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    /* Estilos para el modo claro */
    body.light-mode {
        background: #f8f9fa;
        color: #333;
    }

    /* Estilos para el modo oscuro */
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

    /* Estilo para etiquetas seleccionadas */
    .tag {
        background-color: #0073e6;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin-right: 5px;
        margin-bottom: 5px;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Estilo para botón de eliminar etiquetas */
    .tag-remove {
        cursor: pointer;
    }

    /* Estilo para el campo de etiquetas */
    #tags {
        border: 1px solid #0073e6;
        border-radius: 5px;
        padding: 5px;
        font-size: 16px;
    }

    /* Estilo para el botón de archivo PDF */
    #pdf {
        border: 1px solid #0073e6;
        border-radius: 5px;
        padding: 5px;
        font-size: 16px;
    }
</style>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('panel.user')</strong>
                </div>

                <div class="form-group row">
    <label class="col-md-4 col-form-label" for="profile_image">Foto de Perfil</label>
    <div class="col-md-8">
        <input type="file" class="form-control" id="profile_image" name="profile_image">
    </div>
</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">@lang('panel.name')</label>
                        <div class="col-md-8">
                            <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->name : '' }}" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">@lang('panel.lastname')</label>
                        <div class="col-md-8">
                            <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->surname : '' }}" name="surname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">RFC</label>
                        <div class="col-md-8">
                            <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->rfc : '' }}" name="rfc" style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">@lang('panel.email')</label>
                        <div class="col-md-8">
                            <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->email : '' }}" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">@lang('panel.password')</label>
                        <div class="col-md-8">
                            <input class="form-control" id="text-input" type="password" @if ($method != 'EDIT') required @endif name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">@lang('panel.phone')</label>
                        <div class="col-md-8">
                            <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->phone : '' }}" name="phone" maxlength="10">
                        </div>
                    </div>

                    
   
                    <div class="form-group row">
                        <label for="tags" class="col-md-4 col-form-label">Etiquetas:</label>
                        <div class="col-md-8">
                            <input type="text" id="tags" class="form-control" placeholder="Agrega etiquetas" value="{{ old('tags') }}" name="tags" />
                            <div id="tag-list" style="margin-top: 5px;">
                                <!-- Aquí se mostrarán las etiquetas seleccionadas -->
                            </div>
                        </div>
                    </div>
                 
                    @if ($method == 'EDIT')
          <div class="form-group row">
            <label class="col-md-4 col-form-label" for="text-input">@lang('panel.user_key')</label>
            <div class="col-md-8">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->member_code : $member_code }}" name="member_code" readonly disabled>
            </div>
          </div>
          @endif

          @if (Auth::user()->hasRole('admin'))
          <div class="form-group">
        <label for="roles_id">Rol:</label>
        <select name="roles_id" id="roles_id" class="form-control">
            <option value="1">Admin</option>
            <option value="2">Usuario</option>
            <!-- Agrega más opciones según tus roles disponibles -->
        </select>
    </div>
    @endif


    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">Cliente SAE</label>
                        <div class="col-md-8">
                            <input class="form-control" required id="text" type="text" value="{{ old('clave_sae') }}" name="clave_sae">
                        </div>
                    </div>
                  
                    @php
                    $now = Carbon\Carbon::now();
                    $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
                    @endphp
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="text-input">@lang('panel.register_date')</label>
                        <div class="col-md-8">
                            <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->created_at : $date_formated }}" name="created_at" readonly disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Selecciona el elemento del campo de etiquetas
    var tagsInput = document.getElementById('tags');
    var tagsContainer = document.getElementById('tag-list');

    // Inicializa el plugin Select2 para el campo de etiquetas
    $('#tags').select2({
        tags: true,
        tokenSeparators: [','],
        allowClear: true,
        maximumSelectionLength: 5 // Limita a 5 etiquetas seleccionadas
    });

    // Agrega etiquetas seleccionadas al contenedor
    $('#tags').on('select2:select', function (e) {
        var data = e.params.data;
        var tag = document.createElement('span');
        tag.textContent = data.text;
        tag.className = 'tag';
        tag.setAttribute('data-value', data.id);
        tagsContainer.appendChild(tag);
        updateTagsInput();
    });

    // Elimina etiquetas del contenedor
    tagsContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('tag')) {
            var tag = event.target;
            tagsContainer.removeChild(tag);
            updateTagsInput();
        }
    });

    // Actualiza el valor del campo de etiquetas
    function updateTagsInput() {
        var tags = Array.from(tagsContainer.getElementsByClassName('tag')).map(function (tag) {
            return tag.textContent;
        });
        tagsInput.value = tags.join(', ');
    }

    // Cambia el modo claro/oscuro
    function toggleMode() {
        var body = document.body;
        if (body.classList.contains('dark-mode')) {
            body.classList.remove('dark-mode');
        } else {
            body.classList.add('dark-mode');
        }
    }
</script>
