@extends('adminlte::page')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-image">
            <img src="{{ asset('profile_images/' . $user->profile_image) }}" alt="Perfil de {{ $user->name }}">
        </div>
        <div class="profile-details">
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
        </div>
    </div>
    <div class="profile-form">
        {!! Form::model($user, [
        'action' => ['UsersController@update', $user->id],
        'method' => 'put',
        'files' => true
        ]) !!}
        @include('admin.users.form')
        <div class="card-footer" align="right">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-check"></i> @lang('panel.save')
            </button>
            <a href="{{ URL::previous() }}" class="btn btn-danger">
                <i class="fa fa-ban"></i> @lang('panel.back')
            </a>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<style>
/* Estilos para el contenedor del perfil */
.profile-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #f0f2f5;
    padding: 40px 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 90%;
    margin: 0 auto;
    animation: fadeIn 1s ease-in-out;
}

/* Estilos para el encabezado del perfil */
.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    width: 100%;
    max-width: 800px;
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Estilos para la imagen del perfil */
.profile-image img {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 20px;
    border: 4px solid #007bff;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.profile-image img:hover {
    transform: scale(1.1);
    box-shadow: 0 0 20px rgba(0, 123, 255, 0.6);
}

/* Estilos para los detalles del perfil */
.profile-details h2 {
    font-size: 28px;
    color: #333;
    margin-bottom: 5px;
    font-weight: bold;
    animation: fadeIn 1.2s ease-in-out;
}

.profile-details p {
    font-size: 18px;
    color: #555;
    margin-bottom: 15px;
}

/* Estilos para el formulario de edición */
.profile-form {
    background: #ffffff;
    padding: 30px;
    border: 6px solid #dee2e6;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 800px;
    animation: slideInUp 0.6s ease-in-out;
}

/* Estilos para los botones */
.card-footer button {
    margin-right: 10px;
    background: #218838;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 12px 25px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease-in-out, transform 0.3s;
}

.card-footer button:hover {
    background: #218838;
    transform: translateY(-3px);
}

.card-footer a {
    background: #dc3545;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 12px 25px;
    font-size: 16px;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.3s ease-in-out, transform 0.3s;
}

.card-footer a:hover {
    background: #c82333;
    transform: translateY(-3px);
}

/* Animaciones */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideInUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>

@endsection
