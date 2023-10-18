@extends('admin.styles')@section('content')    <ol class="breadcrumb">        <li class="breadcrumb-item">@lang('panel.home')</li>        <li class="breadcrumb-item active">@lang('panel.orders')</li>    </ol>    @include('flash::message')    <div class="container-fluid">        <div class="animated fadeIn">            <div class="card">                <div class="card-body">                    <div class="row">                        <div class="col-md-6">                            @if (Auth::user()->hasRole('admin'))                                <h4 class="card-title mb-0"><i class="nav-icon fa fa-file"></i> @lang('panel.all_orders')                                </h4>                            @else                                <h4 class="card-title mb-0"><i class="nav-icon fa fa-file"></i> @lang('panel.my_orders')</h4>                            @endif                        </div>                        <div class="col-md-12">                            <br>                            <div class="table-responsive p-t-10">                                <table id="table-orders" class="table" style="width:100%">                                    <thead>                                        <tr align="center">                                            <th>@lang('panel.order_id')</th>                                            <th>@lang('panel.client_name')</th>                                            <th>@lang('panel.city')</th>                                            <th>@lang('panel.address')</th>                                            <th>@lang('panel.postal')</th>                                            <th>@lang('panel.order_amount')</th>                                            <th>@lang('panel.order_date')</th>                                            <th>@lang('panel.actions')</th>                                        </tr>                                    </thead>                                    <tbody>                                        @foreach ($orders as $order)                                            <tr align="center">                                                <td>{{ $order->id }}</td>                                                <td>{{ $order->fname }} {{ $order->lname }}</td>                                                <td>{{ $order->city }}</td>                                                <td>{{ $order->billing_address }}</td>                                                <td>{{ $order->zipcode }}</td>                                                <td>${{ number_format($order->total, 2) }}</td>                                                <td>{{ $order->created_at }}</td>                                                <td>                                                    <ul class="list-inline" style="margin: 0px;">                                                        <li class="list-inline-item">                                                            <a class="btn btn-info btn-sm"                                                                href="{{ route('admin.orders.show', $order->id) }}"                                                                title="{{ trans('panel.show_product') }}">                                                                <i style="color: #fff;" class="fa fa-eye"></i>                                                            </a>                                                        </li>                                                        @if (Auth::user()->hasRole('admin'))                                                            <li class="list-inline-item">                                                                {!! Form::open([                                                                    'class' => 'delete',                                                                    'url' => route('admin.orders.destroy', $order->id),                                                                    'method' => 'DELETE',                                                                ]) !!}                                                                <button class="btn btn-danger btn-sm" title="{{ trans('panel_delete') }}"><i class="fa fa-trash-o"></i></button>                                                                {!! Form::close() !!}                                                            </li>                                                                                                        <li class="list-inline-item">                                                                <a class="btn btn-success btn-sm"                                                                href="{{ url('admin/orders_users/send',$order->id)}}"                                                                title="{{ trans('Enviar Orden') }}"                                                                class="btn btn-primary btn-sm">                                                                    <i class="fa fa-envelope"></i>                                                                </a>                                                            </li>                                                        @endif                                                    </ul>                                                </td>                                            </tr>                                        @endforeach                                    </tbody>                                </table>                            </div>                        </div>                    </div>                </div>            </div>        </div>    </div> {{--    @push('script')        <script>            $(document).ready(function() {                $('#table-reports').DataTable({                    dom: 'Bfrtip',                    buttons: [                        'copy', 'csv', 'excel', 'pdf', 'print'                    ],                    responsive: true,                    bSort: true                });            });        </script>    @endpush --}}    @push('script')    <script>       @if(App::isLocale('es'))            $('#table-orders').DataTable({                "language": {                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"                 },                 "responsive": true,                 "bSort": false,                 "buttons": ['csv', 'excel', 'pdf', 'print']            });        @else           $('#table-orders').DataTable({                "language": {                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json"                 },                 "responsive": true,                 "bSort": false,                 "buttons": ['csv', 'excel', 'pdf', 'print']           });        @endif    </script>    @endpush@endsection