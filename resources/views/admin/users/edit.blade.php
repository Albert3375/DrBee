@extends('admin.styles')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/users') }}">@lang('panel.users')</a></li>
    <li class="breadcrumb-item active">@lang('panel.edit')</li>
</ol>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-image">
        <img src="{{ asset('profile_images/' . $user->profile_image) }}" alt="Perfil de {{ $user->name }}">        </div>
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
        ])
        !!}
        @include('admin.users.form')
        <div class="card-footer" align="right">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-check"></i> @lang('panel.save')</button>
            <a href="{{ URL::previous() }}" class="btn btn-danger">
                <i class="fa fa-ban"></i> @lang('panel.back')</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('script')
</div>

<style>


/* Estilos para el encabezado del perfil */
.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
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

.profile-image img:hover {
    transform: scale(1.05);
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

/* Estilos para el formulario de edición */
.profile-form {
    background: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* Estilos para los botones */
.card-footer button {
    margin-right: 10px;
    background: #0073e6;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.card-footer button:hover {
    background: #0057af;
}

.card-footer a {
    background: #ff2b2b;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.card-footer a:hover {
    background: #ff0000;
}
</style>
@endsection
