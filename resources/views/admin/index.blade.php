@extends('admin.styles')

<style>
    .btn:focus,.btn:hover,.btn.active {
        box-shadow: none;
        outline: medium none;
    }
    button:focus {
        outline:none;
    }
    .btn {
        border-width: 1px;
        cursor: pointer;
        line-height: normal;
        padding: 12px 35px;
        text-transform: capitalize;
        transition: all 0.3s ease-in-out;
    }
    .btn.active:focus, .btn:active:focus {
        box-shadow: none !important;
    }
    .btn-fill-out {
        background-color: transparent;
        border: 1px solid #ff9300;
        color: #fff;
        position: relative;
        overflow: hidden;
        z-index: 1;
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
    .btn-line-fill:before, .btn-line-fill:after {
    position: absolute;
    top: 50%;
    content: '';
    width: 20px;
    height: 20px;
    background-color: #333;
    border-radius: 50%;
    z-index: -1;
}
.btn-line-fill:before {
    left: -20px;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
.btn-line-fill:after {
    right: -20px;
    -webkit-transform: translate(50%, -50%);
    transform: translate(50%, -50%);
}
.btn-line-fill:hover:before {
    -webkit-animation: criss-cross-left 0.7s both;
    animation: criss-cross-left 0.7s both;
    -webkit-animation-direction: alternate;
    animation-direction: alternate;
}
.btn-line-fill:hover:after {
    -webkit-animation: criss-cross-right 0.7s both;
    animation: criss-cross-right 0.7s both;
    -webkit-animation-direction: alternate;
    animation-direction: alternate;
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
