<!-- Incluye jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluye Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />








<!-- Incluye Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>


/* Estilos generales */
body {
    background-color: #f0f0f0; /* Color de fondo suave */
}

.container {
    margin-top: 20px; /* Espacio superior */
}

.card {
    border: 1px solid #ccc;
    background-color: #fff; /* Fondo blanco */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px; /* Espacio inferior */
}

.card-header {
    background: linear-gradient(to right, #007BFF, #0056b3);
    color: #fff;
    text-align: center;
    padding: 15px 0;
    border-radius: 8px 8px 0 0;
    font-family: 'Arial', sans-serif;
}

.card-body {
    padding: 20px; /* Espaciado interno */
}

.card-footer {
    background-color: #f0f0f0; /* Color de fondo del pie de tarjeta */
    padding: 10px 20px;
    border-top: 1px solid #ccc; /* Borde superior */
    border-radius: 0 0 8px 8px;
}

.form-group {
    margin-bottom: 20px; /* Espacio entre grupos de formulario */
}

.form-group label {
    font-weight: bold;
    color: #007BFF;
}

.form-control {
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f9f9f9; /* Fondo de campo */
    color: #333;
    transition: border-color 0.3s, background-color 0.3s;
}

.form-control:focus {
    border-color: #007BFF; /* Color de borde al enfocar */
    background-color: #fff; /* Fondo de campo al enfocar */
    color: #333;
}

.btn-primary {
    background: #007BFF;
    border: none;
    border-radius: 4px;
    padding: 10px 20px; /* Espaciado interno del botón */
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background: #0056b3;
}

/* Estilos específicos para etiquetas y otros elementos */
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

.tag-remove {
    cursor: pointer;
}

#tags, #pdf {
    border: 1px solid #0073e6;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
}

/* Estilos responsivos para dispositivos pequeños */
@media (max-width: 768px) {
    .card {
        box-shadow: none;
        border: none;
    }
    .card-header {
        border-radius: 0;
    }
    .card-footer {
        border-radius: 0;
    }
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

                <div class="form-group">
        <label for="profile_image">Foto de perfil:</label>
        <input type="file" name="profile_image" id="profile_image" class="form-control">
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

                    
   
                  
                    @if ($method == 'EDIT')
          <div class="form-group row">
            <label class="col-md-4 col-form-label" for="text-input">@lang('panel.user_key')</label>
            <div class="col-md-8">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->member_code : $member_code }}" name="member_code" readonly disabled>
            </div>
          </div>
          @endif

          @if (\Auth::user()->hasRole('admin'))
    <div class="form-group">
        <label for="roles_id">Rol:</label>
        <select name="roles_id" id="roles_id" class="form-control" required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
@endif



                  
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