@extends('adminlte::page')

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
        <div class="profile-info">
            <h4>@lang('Informacion del usuario')</h4>
            <ul>
                <li><strong>@lang('panel.name'):</strong> {{ $user->name }}</li>
                <li><strong>@lang('panel.email'):</strong> {{ $user->email }}</li>
                <!-- Agrega más información del usuario aquí -->
            </ul>
        </div>
        <div class="profile-actions">
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
    background: #f0f2f5;
    padding: 40px 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 90%;
    margin: 0 auto;
    animation: fadeIn 1s ease-in-out;
}

/* Estilos para la tarjeta del perfil */
.profile-card {
    background: linear-gradient(to bottom right, #ffffff, #e6e9ef);
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 100%;
    max-width: 800px;
    animation: slideInUp 0.6s ease-in-out;
}

/* Estilos para el encabezado del perfil */
.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
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

/* Efectos al pasar el mouse sobre la imagen del perfil */
.profile-image img:hover {
    transform: scale(1.1);
    box-shadow: 0 0 20px rgba(0, 123, 255, 0.6);
}

/* Estilos para los detalles del perfil */
.profile-details h2 {
    font-size: 32px;
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

/* Estilos para los detalles adicionales del perfil */
.profile-info h4 {
    font-size: 22px;
    color: #007bff;
    margin-bottom: 15px;
    border-bottom: 2px solid #007bff;
    display: inline-block;
    padding-bottom: 5px;
}

.profile-info ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.profile-info ul li {
    margin-bottom: 10px;
    font-size: 16px;
    color: #555;
}

/* Estilos para las acciones del perfil */
.profile-actions {
    text-align: center;
    margin-top: 20px;
}

.profile-actions a.btn {
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    padding: 12px 25px;
    border-radius: 50px;
    transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
}

.profile-actions a.btn:hover {
    background-color: #0056b3;
    box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
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
