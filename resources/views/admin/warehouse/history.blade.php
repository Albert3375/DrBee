@extends('admin.styles')
<style>
    .table_products {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    .table_products td, .table_products th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .table_products tr:nth-child(even){background-color: #f2f2f2;}

    .table_products tr:hover {background-color: #ddd;}
    .table_products th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #04AA6D;
        color: white;
    }
</style>
@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.storage')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="fa fa-warehouse"></i> @lang('panel.storage_history') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                {{-- <h5 class="card-title mb-0">Almacén</h5> --}}
              </div>
              <div class="col-md-6" align="right">
                {{--  <a href="{{ route('admin.warehouse.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> Nuevo Usuario
                  </a> --}}
              </div>
              <div class="col-md-12">
                    <br>
                    <table id="table-warehouse" class="display">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>@lang('panel.status')</th>
                                <th>@lang('panel.user')</th>
                                <th>@lang('panel.purchase_date')</th>
                                <th>@lang('panel.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_orders as $order)
                                <tr align="center">
                                    <td>
                                        {{$order->id}}
                                    </td>
                                    <td>
                                        @if ($order->status != null)
                                            {!! Form::select('status', ['0'=>'Selecciona uno','1'=>'Surtido','2'=>'Reportar'], $order->status, ['class'=>'form-control','disabled']) !!}
                                        @else
                                            @lang('panel.pending')
                                        @endif
                                    </td>
                                    <td>
                                        {{$order->user->name}}
                                    </td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
                                    <td>
                                        <ul class="list-inline" style="margin: 0px;">
                                            <li class="list-inline-item">
                                                <button class="btn btn-success btn-sm" data-target="#detalleModalUser"
                                                    title="{{ trans('panel.show_product') }}" data-toggle="modal"
                                                    data-whatever="{{ $order->id }}" style="color: white">
                                                    <i style="color: #fff;" class="fa fa-eye"></i>
                                                    @lang('panel.see_details')
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($guest_orders as $order)
                                <tr align="center">
                                    <td>
                                        {{$order->id}}
                                    </td>
                                    <td>
                                        @if ($order->status != null)
                                        {!! Form::select('status', ['0'=>trans('panel.select_one'),'1'=>trans('panel.supply'),'2'=>trans('panel.report')], $order->status, ['class'=>'form-control','disabled']) !!}
                                        @else
                                            @lang('panel.pending')
                                        @endif
                                    </td>
                                    <td>
                                        {{$order->fname }} {{ $order->lname }}
                                    </td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
                                    <td>
                                        <ul class="list-inline" style="margin: 0px;">
                                            <li class="list-inline-item">
                                                <button class="btn btn-success btn-sm" data-target="#detalleModalGuest"
                                                    title="{{ trans('panel.show_product') }}" data-toggle="modal"
                                                    data-whatever="{{ $order->id }}" style="color: white">
                                                    <i style="color: #fff;" class="fa fa-eye"></i>@lang('panel.see_details')
                                                </button>
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
          </div>
        </div>

@push('script')
    <script>
        @if(App::isLocale('es'))
            $('#table-warehouse').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "responsive": true,
                "bSort": false
            });
        @else
        $('#table-warehouse').DataTable({
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
