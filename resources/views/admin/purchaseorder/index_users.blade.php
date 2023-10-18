@extends('admin.styles')

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('panel.home')</li>
        <li class="breadcrumb-item active">@lang('panel.orders')</li>
    </ol>

    @include('flash::message')

    <div class="container-fluid">
        <div class="row">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if (Auth::user()->hasRole('admin'))
                                <h4 class="card-title mb-0"><i class="nav-icon fa fa-file"></i> @lang('panel.all_orders')
                                </h4>
                            @else
                                <h4 class="card-title mb-0"><i class="nav-icon fa fa-file"></i> @lang('panel.my_orders')</h4>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <br>
                           <div class="table-responsive p-t-10">
                            <table id="table-orders" class="table" style="width:100%;">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>@lang('panel.order_amount')</th>
                                        {{-- <th>@lang('panel.client_id')</th> --}}
                                        <th>Nombre del Cliente</th>
                                        <th>@lang('panel.address_id')</th>
                                        <th>@lang('panel.order_date')</th>
                                        <th>@lang('panel.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr align="center">
                                            <td>{{ $order->id }}</td>
                                            <td>${{ number_format($order->total, 2) }}</td>
                                            <td>{{ $order->user }}</td>
                                            <td>{{ $order->address->title }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <ul class="list-inline" style="margin: 0px;">
                                                    <li class="list-inline-item">
                                                        <a class="btn btn-info btn-sm"
                                                            href="{{ route('admin.orders_users.show', $order->id) }}"
                                                            title="{{ trans('panel.show_product') }}">
                                                            <i style="color: #fff;" class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    </li>
                                                    {{-- <li class="list-inline-item">
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="{{ route('admin.user_information', $order->user_id) }}"
                                                            title="{{ trans('panel.show_user') }}">
                                                            <i style="color: #fff;" class="fa fa-user"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('admin.adress_information', $order->address_id) }}"
                                                            title="{{ trans('panel.show_address') }}">
                                                            <i style="color: #fff;" class="fa fa-info-circle"></i>
                                                        </a>
                                                    </li> --}}
                                                    {{-- <li class="list-inline-item">
                                                        <a class="btn btn-success btn-sm"
                                                        href="{{ url('admin/orders_users/download/'.$order->id)}}"
                                                        title="{{ trans('Descargar Información') }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-download"></i>
                                                        </a>
                                                    </li> --}}
                                                    @if (Auth::user()->hasRole('admin'))

                                                        <li class="list-inline-item">
                                                            <a class="btn btn-success btn-sm"
                                                            href="{{ url('admin/orders/send',$order->id)}}"
                                                            title="{{ trans('Enviar Orden') }}"
                                                            class="btn btn-primary btn-sm">
                                                                <i class="fa fa-envelope"></i>
                                                            </a>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            {!! Form::open([
                                                                'class' => 'delete',
                                                                'url' => route('admin.orders_users.destroy', $order->id),
                                                                'method' => 'DELETE',
                                                            ]) !!}
                                                            <button class="btn btn-danger btn-sm"
                                                                title="{{ trans('panel.delete') }}"><i
                                                                    class="fa fa-trash-o"></i></button>
                                                            {!! Form::close() !!}
                                                        </li>
                                                    @else

                                                    @endif
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
            </div>
        </div>
    </div>
</div>
{{--     @push('script')
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    bSort: true,
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>

    @endpush --}}

    @push('script')
    <script>
       @if(App::isLocale('es'))
            $('#table-orders').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
                 },
                 "responsive": true,
                  "dom": 'Bfrtip',
                "bSort": false,
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        @else
           $('#table-orders').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json"
                 },
                 "responsive": true,
                "dom": 'Bfrtip',
                "bSort": false,
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
           });
        @endif
    </script>
    @endpush

@endsection
