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
                                <a class="btn btn-success" href="{{ url('admin/orders/download/'.$order->id)}}" title="{{ trans('Descargar Información') }}">
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
                        <div class="card-header">

                            <table class="table">
                                <thead style="background-color: #002b4c; color:white;">
                               <tr>
                                   <th>
                                        <h4 class="mb-2">
                                <i class="fa fa-info-circle"></i>
                                Información del Pedido
                            </h4>
                                   </th>
                               </tr> 
                            </thead>

                            <table class="table">
                                <thead class="">
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
                                    {!! Form::hidden('id', $order->id, ['id'=>'id']) !!}
                                        {{-- @foreach ($orders as $order) --}}
                                            <tr align="center">
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->address->title}}</td>
                                                <td>{{ $order->created_at}}</td>
                                                {{-- <td><img src="{{ URL($product->img)}}" style="width: 150px !important; height: 150px !important; max-width: 80%;"></td> --}}
                                                <td>
                                                    {!! Form::select('status', $status, $order->status_pay, ['class'=>'form-control','id'=>'status']) !!}
                                                </td>
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
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                    <div class="shadow card bg-light">
                        <div class="card-header">

                            <table class="table">
                                <thead style="background-color: #002b4c; color:white;">
                               <tr>
                                   <th>
                                       <h4 class="mb-2">
                                <i class="fa fa-info-circle"></i>
                                Información de los productos
                            </h4>
                                   </th>
                               </tr> 
                            </thead>

                            
            
                            <table class="table">
                                <thead class="">
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

        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    
                        <div class="col-md-12">
                    <div class="shadow card">
                        <div class="card-header">
                             <table class="table">
                                <thead style="background-color: #002b4c; color:white;">
                               <tr>
                                   <th><h4 class="mb-2">
                                    <i class="fas fa-user"></i>
                                    @lang('panel.user_info')
                                </h4></th>
                               </tr> 
                            </thead>


                    
                        </table>
                           
                            <div class="row" align="center">
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000;border-top: 1px solid #000;">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.name'):</h5>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-right: 1px solid #000; border-top: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">
                                        {{ $user->name }} 

                            
                                    </p>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.email')
                                    </h5>
                                </div>
                                <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">
                                            {{ $user->email }} 
                                    </p>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.phone')
                                    </h5>
                                </div>
                                @if($user->phone == null)
                                <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">
                                        @lang('panel.unavailable')
                                    </p>
                                </div>
                                @else
                                <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                            {{ $user->phone }}
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                        
                    </div>
                </div>
            </div>
        </div>

    <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    
                        <div class="col-md-12">
                    <div class="shadow card bg-light">
                        <table class="table">
                                <thead style="background-color: #002b4c; color:white;">
                               <tr>
                                   <th><h4 class="mb-2">
                                    <i class="fas fa-map-marker"></i>
                                    @lang('panel.address_info')
                                    </h4></th>
                               </tr> 
                            </thead>
                    
                        </table>
                           
                        <div class="card-header">
                        
                           
                            <div class="row" align="center">
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000;border-top: 1px solid #000;">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.title'):</h5>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-right: 1px solid #000; border-top: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">
                                        {{ $address->title }} 

                            
                                    </p>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.street')
                                    </h5>
                                </div>
                                <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">
                                            {{ $address->street }} {{ $address->numberExt }} 
                                    </p>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.colony')
                                    </h5>
                                </div>
                               <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                            {{ $address->col }}
                                    </p>
                                </div>

                                <div class="col-md-6"
                                style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.municipality')
                                </h5>
                            </div>
                           <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                        {{ $address->municipality }}
                                </p>
                            </div>

                            <div class="col-md-6"
                            style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                            <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.state')
                            </h5>
                        </div>
                       <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                            <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                    {{ $address->state }}
                            </p>
                        </div>

                        <div class="col-md-6"
                        style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                        <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.country')
                        </h5>
                    </div>
                   <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                        <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                {{ $address->country }}
                        </p>
                    </div>

                    <div class="col-md-6"
                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.postal')
                    </h5>
                </div>
               <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                            {{ $address->postalCode }}
                    </p>
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
                $.post(' {{ url("admin/updateStatusOrder")}}',dato,function(data){
                    $('#status').val(data);
                    // alert(data)
                })
            })

        </script>

    @endpush

@endsection
