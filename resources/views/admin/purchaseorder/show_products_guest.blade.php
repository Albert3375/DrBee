@extends('admin.styles')

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('panel.home')</li>
        <li class="breadcrumb-item"><a href="{{URL('/admin')}}">@lang('panel.orders')</a></li>
        <li class="breadcrumb-item active">Detalle de Orden</li>
    </ol>

    @include('flash::message')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" align="center">
                                <a class="btn btn-success" href="{{ url('admin/orders/download_order_guest/'.$order->id)}}" title="{{ trans('Descargar Información') }}">
                                    <h4 class="card-title mb-0"><i class="fa fa-download"> Descargar Orden de Compra</i></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="shadow card bg-light">
                                <div class="card-body">
                                    <h4 class="mb-2">
                                        <i class="fa fa-info-circle"></i>
                                        Información del Pedido
                                    </h4>
                                    <hr>
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>@lang('panel.order_id')</th>
                                                <th>@lang('panel.client_name')</th>
                                                <th>@lang('panel.city')</th>
                                                <th>@lang('panel.address')</th>
                                                <th>@lang('panel.postal')</th>
                                                <th>@lang('panel.order_amount')</th>
                                                <th>@lang('panel.order_date')</th>
                                                <th>Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {!! Form::hidden('id', $order->id, ['id'=>'id']) !!}
                                                {{-- @foreach ($orders as $order) --}}
                                                    <tr align="center">
                                                        <td>{{ $order->id }}</td>
                                                        <td>{{ $order->fname }} {{ $order->lname }}</td>
                                                        <td>{{ $order->city }}</td>
                                                        <td>{{ $order->billing_address }}</td>
                                                        <td>{{ $order->zipcode }}</td>
                                                        <td>${{ number_format($order->total, 2) }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>
                                                            {!! Form::select('status', $status, $order->status_pay, ['class'=>'form-control','id'=>'status']) !!}
                                                        </td>
                                                    </tr>
                                                {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                    <div class="shadow card bg-light">
                        <div class="card-body">
                            <h4 class="mb-2">
                                <i class="fa fa-info-circle"></i>
                                Información de los productos
                            </h4>
                            <hr>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Nombre del Producto</th>
                                        <th scope="col">Cantidad Comprada</th>
                                        <th scope="col">Descuento</th>
                                        <th scope="col">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach (json_decode($order->products) as $product)
                                            <tr align="center">
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->quantity}}</td>
                                                <td>{{$product->discount}}</td>
                                                <td>$ {{ number_format($product->price,2)}}</td>
                                                {{-- <td><img src="{{ URL($product->img)}}" style="width: 150px !important; height: 150px !important; max-width: 80%;"></td> --}}
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
            $('#status').on('change',function(){

                var dato = {
                    'id' : $('#id').val(),
                    'status' : $('#status').val(),
                    '_token' : '{{ csrf_token() }}',
                }
                $.post(' {{ url("admin/updateStatusOrderGuest")}}',dato,function(data){
                    $('#status').val(data);
                    // alert(data)
                })
            })

        </script>

    @endpush

@endsection
