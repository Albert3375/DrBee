@extends('admin.styles')

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ URL('/admin/purchase_orders') }}">@lang('panel.purchase_orders')</a></li>
        <li class="breadcrumb-item active">Orden de Compra</li>
    </ol>

    @include('flash::message')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><i class="nav-icon fa fa-file"></i> @lang('panel.purchase_order_details')
                        #{{ $order->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="shadow card bg-light">
                                <div class="card-body">
                                    <h4 class="mb-2">
                                        <i class="fa fa-user"></i>
                                        @lang('panel.client_info')
                                    </h4>
                                    <hr>
                                    <div class="mt-4 mt-lg-1 row">
                                        <div class="col-lg-8 col-sm-8">
                                            <h5>@lang('panel.name'):</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="font-weight: 500; font-size: 18px;">
                                                {{ $order->fname }}
                                            </p>
                                        </div>
                                        <div class="col-lg-8 col-sm-8">
                                            <h5>@lang('panel.phone'):</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="font-weight: 500; font-size: 18px;">
                                                {{ $order->phone }}
                                            </p>
                                        </div>
                                        <div class="col-lg-8 col-sm-8">
                                            <h5>@lang('panel.send_to')</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="font-weight: 500; font-size: 18px;">
                                                {{ $order->email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="col-md-12">
                            <div class="shadow card bg-light">
                                <div class="card-body">
                                    <h4 class="mb-2">
                                        <i class="fa fa-map-marker"></i>
                                        @lang('panel.delivery_address')
                                    </h4>
                                    <hr>
                                    <div class="mt-4 mt-lg-1 row">
                                        <div class="col-lg-8 col-sm-8">
                                            <h5>@lang('panel.state'):</h5>
                                        </div>
                                        <div class="col-lg-8 col-sm-8">
                                            <h5>@lang('panel.city'):</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="font-weight: 500; font-size: 18px;">
                                                {{ $order->city }}
                                            </p>
                                        </div>
                                        <div class="col-lg-8 col-sm-8">
                                            <h5>@lang('panel.street_number'):</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="font-weight: 500; font-size: 18px;">
                                                {{ $order->billing_address }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="col-md-12">
                            <div class="shadow card bg-light">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                    <div class="shadow card bg-light">
                                        <div class="card-body">
                                            <h4 class="mb-2">
                                                <i class="fa fa-cloud"></i>
                                                 @lang('panel.payment_method')
                                            </h4>
                                            <hr>
                                            <table class="table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Id del Pedido</th>
                                                        <th scope="col">Fecha de Compra</th>
                                                        <th scope="col">Dirección de Envío</th>
                                                        <th scope="col">Estatus del pedido</th>
                                                        <th scope="col">Método de pago</th>
                                                        <th scope="col">Total del Pedido</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        {{-- @foreach ($orders as $order) --}}
                                                            <tr align="center">
                                                                <td>{{$order->id}}</td>
                                                                <td>{{$order->address->title}}</td>
                                                                <td>{{ $order->created_at}}</td>
                                                                {{-- <td><img src="{{ URL($product->img)}}" style="width: 150px !important; height: 150px !important; max-width: 80%;"></td> --}}
                                                                <td>{{ $order->status_pay }}</td>
                                                                <td>{{ $order->payment_method}}</td>
                                                                <td>$ {{ number_format($order->total,2)}}</td>
                                                            </tr>
                                                        {{-- @endforeach --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="col-md-12">
                            <div class="shadow card bg-light">
                                <div class="card-body">
                                    <h4>
                                        <i class="fa fa-file"></i>
                                        @lang('panel.purchase_details')
                                    </h4>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            @foreach ($order->products as $product)
                                                <div class="col-sm-8">
                                                    <h5>@lang('panel.product_name'):</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p style="font-weight: 500; font-size: 18px;">{{ $product->name }}
                                                    </p>
                                                </div>
                                                <br>
                                                <div class="col-sm-8">
                                                    <h5>@lang('panel.product_amount'):</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p style="font-weight: 500; font-size: 18px;">
                                                        {{ $product->quantity }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    @endpush

@endsection
