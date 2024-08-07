@extends('adminlte::page')

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('panel.home')</li>
        <li class="breadcrumb-item active">@lang('panel.dashboard')</li>
    </ol>

    <div class="container-fluid">

        <!-- Bienvenida y Resumen -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title">@lang('panel.welcome'), {{ \Auth::user()->name }} {{ \Auth::user()->surname }}</h5>
                    </div>
                    <div class="card-body">
                        <p>@lang('panel.current_date'): {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">@lang('panel.total_users')</h6>
                                        <p class="card-text">{{ count($users) }}</p>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">@lang('Total de productos')</h6>
                                        <p class="card-text">{{ count($products) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (\Auth::user()->hasRole('admin'))
        <!-- Secciones visibles solo para el Admin -->
        <!-- Acciones Rápidas -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title">@lang('Acciones Rápidas')</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ URL('admin/users') }}" class="btn btn-primary btn-block">@lang('Usuarios')</a>
                        <a href="{{ URL('admin/orders') }}" class="btn btn-success btn-block">@lang('Pedidos')</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de Clientes y Productos -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">@lang('Lista de clientes')</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('ID')</th>
                                        <th>@lang('Noombre')</th>
                                        <th>@lang('Correo')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="card-title">@lang('Lista de productos')</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('panel.product_id')</th>
                                        <th>@lang('panel.product_name')</th>
                                        <th>@lang('Precio del Producto')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>${{ number_format($product->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Secciones visibles solo para usuarios regulares -->
        @if (\Auth::user()->hasRole('user'))
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title">@lang('panel.recent_orders')</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <!-- Aquí puedes agregar un loop para mostrar las órdenes recientes del usuario -->
                            <li class="list-group-item">@lang('panel.order') #1234 - @lang('panel.status'): @lang('panel.completed')</li>
                            <li class="list-group-item">@lang('panel.order') #1235 - @lang('panel.status'): @lang('panel.pending')</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">@lang('panel.recommended_products')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Aquí puedes agregar un loop para mostrar productos recomendados para el usuario -->
                            <div class="col-md-6">
                                <div class="card">
                                    <img src="ruta/a/imagen" class="card-img-top" alt="@lang('panel.product_image')">
                                    <div class="card-body">
                                        <h6 class="card-title">@lang('panel.product_name')</h6>
                                        <p class="card-text">$19.99</p>
                                        <a href="#" class="btn btn-primary">@lang('panel.add_to_cart')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <img src="ruta/a/imagen" class="card-img-top" alt="@lang('panel.product_image')">
                                    <div class="card-body">
                                        <h6 class="card-title">@lang('panel.product_name')</h6>
                                        <p class="card-text">$29.99</p>
                                        <a href="#" class="btn btn-primary">@lang('panel.add_to_cart')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Sección visible para todos los usuarios -->
        <!-- Botón para Continuar Comprando -->
        <div class="row mb-4 justify-content-center">
            <div class="col-lg-6 col-md-12 mb-3 mb-md-0 text-center">
                <a href="{{ URL('/products') }}" class="btn btn-lg btn-primary btn-fill-out">
                    <i class="fas fa-shopping-basket"></i>
                    @lang('cart.continue')
                </a>
            </div>
        </div>

    </div>

@endsection

@section('css')
    <style>
        .card {
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .btn {
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        table {
            width: 100%;
            margin-bottom: 0;
            color: #333;
        }

        table thead th {
            background-color: #f8f9fa;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        table tbody tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        .breadcrumb {
            background-color: #e9ecef;
            border-radius: 5px;
            padding: 10px 15px;
        }

        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .list-group-item {
            border: none;
            padding: 10px 15px;
            background-color: #f8f9fa;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .list-group-item:hover {
            background-color: #e2e6ea;
        }

        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
@endsection
