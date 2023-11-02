@extends('admin.styles')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ URL('admin/users') }}">@lang('panel.users')</a></li>
        <li class="breadcrumb-item active">@lang('panel.profile')</li>
    </ol>
</div>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-image">
            <img src="{{ asset('profile_images/' . $user->profile_image) }}" alt="Perfil de {{ $user->name }}">

            </div>
            <div class="profile-details">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
            </div>
        </div>
        <div class="profile-details">
            <h4>@lang('Informacion del usuario')</h4>
            <ul>
                <li><strong>@lang('panel.name'):</strong> {{ $user->name }}</li>
                <li><strong>@lang('panel.email'):</strong> {{ $user->email }}</li>
                <!-- Agrega más información del usuario aquí -->
            </ul>
        </div>
        <div class="profile-details">
            <h4>@lang('panel.actions')</h4>
            <a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}">
                <i class="fa fa-edit"></i> @lang('Editar perfil')
            </a>
        </div>
    </div>
</div>

<style>
/* Estilos para el contenedor del perfil */
.profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, #0f4c75, #3282b8);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 115, 230, 0.3);
    width: 70%; /* Ajusta el ancho del contenedor del perfil */
    margin: 0 auto;
}

/* Estilos para la tarjeta del perfil */
.profile-card {
    background: #ffffff;
    border: 2px solid #ff9500;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 115, 230, 0.3);
    transition: transform 0.3s;
    padding: 20px;
}

/* Efecto de aumento al pasar el mouse sobre la tarjeta */
.profile-card:hover {
    transform: scale(1.03);
}

/* Estilos para el encabezado del perfil */
.profile-header {
    display: flex;
    align-items: center;
}

/* Estilos para la imagen del perfil */
.profile-image img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 20px;
    border: 4px solid #0073e6;
    transition: transform 0.3s ease-in-out;
}

/* Estilos para los detalles del perfil */
.profile-details h2 {
    font-size: 24px;
    color: #333;
    margin: 0;
}

.profile-details p {
    color: #555;
    margin: 0;
}

/* Estilos para los detalles adicionales del perfil */
.profile-details ul {
    list-style: none;
    padding: 0;
}

.profile-details ul li {
    margin-bottom: 10px;
}

/* Estilos para el botón de edición */
.profile-details a.btn {
    text-decoration: none;
    color: #fff;
    background-color: #0073e6;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.profile-details a.btn:hover {
    background-color: #0052a3;
}
</style>

@endsection
