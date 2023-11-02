@extends('admin.styles')

<style>
    .btn:focus, .btn:hover, .btn.active {
        box-shadow: 0 0 10px rgba(255, 147, 0, 0.5);
        transform: scale(1.05);
    }
    
    button:focus {
        outline: none;
    }
    
    .btn {
 
        cursor: pointer;
        line-height: normal;
        padding: 12px 35px;
        text-transform: uppercase;
        transition: all 0.3s ease-in-out;
        background: linear-gradient(to right, #ff9300, #ff6700);
        color: #fff;
        border-radius: 5px;
        position: relative;
        overflow: hidden;
    }
    
    .btn.active:focus, .btn:active:focus {
        box-shadow: none !important;
    }
    
    .btn-fill-out::before,
    .btn-fill-out::after {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        background-color: #ff9300;
        z-index: -1;
        transition: all 0.3s ease-in-out;
        width: 51%;
    }
    
    .btn-fill-out::after {
        right: 0;
        left: auto;
    }
    
    .btn-fill-out:hover:before,
    .btn-fill-out:hover:after {
        width: 0;
    }
    
    .btn-fill-out:hover {
        color: #ff9300 !important;
    }
    
    .btn-line-fill::before, .btn-line-fill::after {
        position: absolute;
        top: 50%;
        content: '';
        width: 20px;
        height: 20px;
        background-color: #333;
        border-radius: 50%;
        z-index: -1;
        transform: translate(-50%, -50%);
        transition: transform 0.3s ease-in-out;
    }
    
    .btn-line-fill::before {
        left: -20px;
    }
    
    .btn-line-fill::after {
        right: -20px;
        transform: translate(50%, -50%);
    }
    
    .btn-line-fill:hover::before {
        animation: criss-cross-left 0.7s both;
    }
    
    .btn-line-fill:hover::after {
        animation: criss-cross-right 0.7s both;
    }
    
    @keyframes criss-cross-left {
        0% {
            transform: translate(-50%, -50%) scale(1);
        }
        100% {
            transform: translate(-50%, -50%) scale(1.5);
        }
    }
    
    @keyframes criss-cross-right {
        0% {
            transform: translate(50%, -50%) scale(1);
        }
        100% {
            transform: translate(50%, -50%) scale(1.5);
        }
    }

    .container-fluid {
        animation: fadeIn 1s;
    }

    .card {
        border: 2px solid #ff9500;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 115, 230, 0.3);
        background: #ffffff;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.03);
    }

    .card-header {
        background-color: #0073e6;
        color: white;
        padding: 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-body {
        padding: 20px;
    }

    .buttons {
        text-decoration: none;
    }

    .card.bg-secondary, .card.bg-success, .card.bg-warning, .card.bg-danger, .card.bg-primary {
        border: none;
        border-radius: 10px;
        margin: 10px 0;
        box-shadow: 0 0 20px rgba(0, 115, 230, 0.3);
        transition: transform 0.3s ease-in-out;
    }

    .card.bg-secondary:hover, .card.bg-success:hover, .card.bg-warning:hover, .card.bg-danger:hover, .card.bg-primary:hover {
        transform: scale(1.03);
    }

    .buttons .nav-icon {
        font-size: 30px;
    }

    @keyframes breadcrumbScale {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(1.05);
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('panel.home')</li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title mb-0"></h4>
                            <div class="small text-muted">
                                @php
                                    $date = Carbon\Carbon::now();
                                    $newHour = $date->isMidday();
                                    $dateFormated = Carbon\Carbon::parse($date)->format('d/m/Y');
                                    $hour = Carbon\Carbon::parse($date)->format('H:i');
                                    $name = \Auth::user()->name;
                                    $surname = \Auth::user()->surname;
                                @endphp
                                <h5 style="color:black;">
                                    @lang('panel.welcome'), {{ $name }} {{ $surname }}.
                                </h5>
                                <h5 style="color:black;">
                                    @lang('panel.time_pre'), {{ $hour }} @lang('panel.time_post')
                                    @if ($date->dayOfWeekIso == 1)
                                        @lang('panel.monday')
                                    @elseif($date->dayOfWeekIso == 2)
                                        @lang('panel.tuesday')
                                    @elseif($date->dayOfWeekIso == 3)
                                        @lang('panel.wednesday')
                                    @elseif($date->dayOfWeekIso == 4)
                                        @lang('panel.thursday')
                                    @elseif($date->dayOfWeekIso == 5)
                                        @lang('panel.friday')
                                    @elseif($date->dayOfWeekIso == 6)
                                        @lang('panel.saturday')
                                    @elseif($date->dayOfWeekIso == 7)
                                        @lang('panel.sunday')
                                    @endif
                                    {{ $date->day }} @lang('panel.of')
                                    @if ($date->month == 1)
                                        @lang('panel.january')
                                    @elseif($date->month == 2)
                                        @lang('panel.february')
                                    @elseif($date->month == 3)
                                        @lang('panel.march')
                                    @elseif($date->month == 4)
                                        @lang('panel.april')
                                    @elseif($date->month == 5)
                                        @lang('panel.may')
                                    @elseif($date->month == 6)
                                        @lang('panel.june')
                                    @elseif($date->month == 7)
                                        @lang('panel.july')
                                    @elseif($date->month == 8)
                                        @lang('panel.august')
                                    @elseif($date->month == 9)
                                        @lang('panel.september')
                                    @elseif($date->month == 10)
                                        @lang('panel.october')
                                    @elseif($date->month == 11)
                                        @lang('panel.november')
                                    @elseif($date->month == 12)
                                        @lang('panel.december')
                                    @endif
                                    @lang('panel.of') {{ $date->year }}.
                                </h5>
                            </div>
                        </div>
                    </div>

                    <br>
                    @if (Auth::user()->hasRole('admin'))

                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ URL('admin/users') }}" class="buttons"><div class="card text-white bg-secondary">
                                    <div class="card-body pb-0">
                                        <div class="btn-group float-right">
                                            <i style="font-size: 30px;" class="nav-icon fas fa-users"></i>
                                        </div>
                                        <div class="text-value">
                                            {{ count($users) }}
                                        </div>
                                        <div>
                                            <h4>@lang('panel.total_users')</h4>
                                        </div>
                                    </div>
                                </div></a>
                            </div>

                            <div class="col-md-4">
                               <a href="{{ URL('admin/users') }}" class="buttons"> <div class="card text-white bg-success">
                                    <div class="card-body pb-0">
                                        <div class="btn-group float-right">
                                            <i style="font-size: 30px;" class="nav-icon fas fa-user"></i>
                                        </div>
                                        <div class="text-value">
                                            {{ count($clients) }}
                                        </div>
                                        <div>
                                            <h4>@lang('panel.clients')</h4>
                                        </div>
                                    </div>
                                </div></a>
                            </div>

                            <div class="col-md-4">
                                <a href="{{ URL('admin/orders_users') }}" class="buttons"><div class="card text-white bg-warning">
                                    <div class="card-body pb-0">
                                        <div class="btn-group float-right">
                                            <i style="font-size: 30px;" class="nav-icon fas fa-shopping-cart"></i>
                                        </div>
                                        <div class="text-value">
                                            {{ count($sales) }}
                                        </div>
                                        <div>
                                            <h4>@lang('panel.sales')</h4>
                                        </div>
                                    </div>
                                </div></a>
                            </div>

                            <div class="col-md-6">
                                <a href="{{ URL('admin/products') }}" class="buttons"><div class="card text-white bg-danger">
                                    <div class="card-body pb-0">
                                        <div class="btn-group float-right">
                                            <i style="font-size: 30px;" class="nav-icon fas fa-shopping-basket"></i>
                                        </div>
                                        <div class="text-value">
                                            {{ count($products) }}
                                        </div>
                                        <div>
                                            <h4>@lang('panel.products')</h4>
                                        </div>
                                    </div>
                                </div></a>
                            </div>


                            <div class="col-md-6">
                                <a href="{{ URL('admin/categories') }}" class="buttons"><div class="card text-white bg-primary">
                                    <div class="card-body pb-0">
                                        <div class="btn-group float-right">
                                            <i style="font-size: 30px;" class="nav-icon fas fa-bars"></i>
                                        </div>
                                        <div class="text-value">
                                            {{ count($categories) }}
                                        </div>
                                        <div>
                                            <h4>@lang('panel.categories')</h4>
                                        </div>
                                    </div>
                                </div></a>
                            </div>

                        @elseif(Auth::user()->hasRole('user'))
                            <div class="row">
                                <a href="{{ URL('admin/orders') }}" class="buttons">
                                    <div class="col-md-12" align="center">
                                    <div class="card text-white bg-info">
                                        <div class="card-body pb-0">
                                             <div class="btn-group float-right">
                                                <i style="font-size: 30px;" class="nav-icon fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="text-value">
                                                {{ count($orders) }}
                                            </div>
                                            <div>
                                                <h4>Mis pedidos</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                {{-- <div class="col-sm-6 col-lg-3">
                                    <div class="card text-white bg-info">
                                        <div class="card-body pb-0">
                                            <div class="btn-group float-right">
                                                <i style="font-size: 30px;" class="nav-icon fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="text-value">
                                                {{ count($orders) }}
                                            </div>
                                            <div>
                                                <h4>@lang('panel.purchases')</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                    @endif


                    <hr/>
                    <div class="col-md-12" align="center">
                       <!-- {{--  <button class="btn btn-success"><a class="buttons" href="{{URL('/')}}">@lang('panel.buy_again')</a></button> --}} -->
                       <div class="row">
                        <div class="col-lg-12 col-md-6 mb-3 mt-3 mb-md-0" align="center">
                            <a href="{{URL('/products')}}" class="btn btn-lg btn-fill-out">
                                <i class="fas fa-shopping-basket"></i>
                                @lang('cart.continue')
                            </a>
                        </div>

                         <!-- <div class="col-lg-6 col-md-6 mb-3 mt-3 mb-md-0" align="center">
                            <a href="{{ url('checkout') }}" class="btn btn-lg btn-fill-out">
                                <i class="fas fa-shopping-basket"></i>
                                Finalizar compra
                            </a>
                        </div> -->
                        </div>


                       {{-- <div class="w3-container">
                            @if ($message = Session::get('success'))
                            <div class="w3-panel w3-green w3-display-container">
                                <span onclick="this.parentElement.style.display='none'"
                                        class="w3-button w3-green w3-large w3-display-topright">&times;</span>
                                <p>{!! $message !!}</p>
                            </div>
                            <?php Session::forget('success');?>
                            @endif

                            @if ($message = Session::get('error'))
                            <div class="w3-panel w3-red w3-display-container">
                                <span onclick="this.parentElement.style.display='none'"
                                        class="w3-button w3-red w3-large w3-display-topright">&times;</span>
                                <p>{!! $message !!}</p>
                            </div>
                            <?php Session::forget('error');?>
                            @endif

                            <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form" action="{!! URL::to('paypal') !!}">
                              <div class="w3-container w3-teal w3-padding-16">Paywith Paypal</div>
                              {{ csrf_field() }}
                              <h2 class="w3-text-blue">Payment Form</h2>
                              <p>Demo PayPal form - Integrating paypal in laravel</p>
                              <label class="w3-text-blue"><b>Enter Amount</b></label>
                              <input class="w3-input w3-border" id="amount" type="text" name="amount">
                              <button class="w3-btn w3-blue">Pay with PayPal</button>
                            </form>
                        </div> --}}

                    </div>


                    </div>
                </div>
            </div>
            <style>
    /* Estilo para la tarjeta */
    .futuristic-card {
        background: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
        margin: 20px;
        padding: 20px;
    }

    .futuristic-card:hover {
        transform: scale(1.03);
    }

    /* Estilo para el título de la tarjeta */
    .card-title {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    /* Estilo para el subtítulo */
    .sub-title {
        font-size: 18px;
        text-align: center;
        color: #555;
    }

    /* Estilo para la lista de usuarios */
    .user-list {
        list-style: none;
        padding: 0;
    }

    .user-list-item {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .user-list-item:hover {
        transform: scale(1.02);
    }

    /* Animaciones */
    .animated {
        animation-duration: 0.5s;
    }

    .fadeInUp {
        animation-name: fadeInUp;
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>


@if (Auth::user()->hasRole('admin'))
<div class="card-container">
    <div class="card futuristic-card">
        <div class="card-header">
            <h4 class="card-title">Usuarios Recientes</h4>
        </div>
        <div class="card-body">
            <h5 class="sub-title">¡Descubre a los nuevos miembros!</h5>
            <ul class="user-list">
                @foreach ($users as $user)
                <li class="user-list-item animated fadeInUp">
                    {{ $user->name }} {{ $user->surname }} - Compras realizadas: {{ count($orders) }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif




        </div>


        
        <!-- /.card-->
      
        @if (Auth::user()->hasRole('admin'))
        
        @elseif(Auth::user()->hasRole('user'))
        
           <!-- <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><i class="nav-icon fa fa-dropbox"></i>@lang('panel.orders')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title mb-0">@lang('panel.all_orders')</h5>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <table id="table-orders" class="display">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>@lang('panel.order_amount')</th>
                                        <th>@lang('panel.client_id')</th>
                                        <th>@lang('panel.adress_id')</th>
                                        <th>@lang('panel.order_date')</th>
                                        <th>@lang('panel.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr align="center">
                                        <td>{{ $order->id }}</td>
                                        <td>${{ number_format($order->total, 2) }}</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>{{ $order->address_id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <ul class="list-inline" style="margin: 0px;">
                                                <li class="list-inline-item">
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('admin.orders_users.show', $order->id) }}"
                                                        title="{{ trans('Ver Datos de los Productos') }}">
                                                        <i style="color: #fff;" class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ route('admin.user_information', $order->user_id) }}"
                                                        title="{{ trans('Ver Datos del usuario') }}">
                                                        <i style="color: #fff;" class="fa fa-eye"></i>
                                                    </a>
                                                </li>

                                                   <li class="list-inline-item">
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('admin.adress_information', $order->address_id) }}"
                                                        title="{{ trans('Ver Datos de Dirección') }}">
                                                        <i style="color: #fff;" class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>  -->




<style>

/* Estilos para el contenedor que rodea la tarjeta */
.card-container {
    display: flex;
    justify-content: center;
    align-items: center;
    
}

/* Estilos para la tarjeta más pequeña */
.small-card {
    width: 70%;
}


.compact-table th,
.compact-table td {
    padding: 8px 10px; /* Reducir el espacio interno de celdas */
    text-align: left;
}

/* Efectos de hover */
.table-row:hover {
    background-color: #cde2ff;
    transition: background-color 0.3s;
    cursor: pointer;
}


</style>

    @push('script')
        <script>
            @if (App::isLocale('es'))
                $('#table-products').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "responsive": true,
                "bSort": false
                });
            @else
                $('#table-products').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                },
                "responsive": true,
                "bSort": false
                });
            @endif

            @if (App::isLocale('es'))
                $('#table-orders').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "responsive": true,
                "bSort": false
                });
            @else
                $('#table-orders').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                },
                "responsive": true,
                "bSort": false
                });
            @endif
        </script>
    @endpush

@endsection
