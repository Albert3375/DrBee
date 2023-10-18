{{-- @extends('admin.styles')
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

  <div class="modal" tabindex="-1" role="dialog" id="myModalSurtido">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('panel.confirm_pack')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>@lang('panel.want_confirm')<label id="Pedido"></label>?
          </p>
        </div>
        <div class="modal-footer">
            {!! Form::hidden('typeOrder', '',['id'=>'typeOrder']) !!}
          <button type="button" class="btn btn-primary" id="confirmar">@lang('panel.confirm')</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.close')</button>
        </div>
      </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModalReporte">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('panel.pack_status')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>@lang('panel.describe_issue')</h4>
          <p>@lang('panel.order_id'): <label id="Pedido1"></label>
          </p>
          <textarea class="form-control" cols="65" style="resize:none" placeholder=@lang('panel.example_issue')></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger">@lang('panel.report_now')</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.cancel')</button>
        </div>
      </div>
    </div>
</div>

@foreach($user_orders as $order)
    <div class="modal" tabindex="-1" role="dialog" id="Order_user-{{$order->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('panel.order_status')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>@lang('panel.order_details')</h4>
                    <p>@lang('panel.following')</p>
                    <p><b>@lang('panel.client'): {{$order->user->name . ' ' . $order->user->surname}}</b><p>
                    <table class="table_products">
                    <thead>
                    <tr align="center">
                        <th>#</th>
                        <th>@lang('panel.product_name')</th>
                        <th>@lang('panel.amount')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $products = (json_decode($order->products)); $i=1; $total=0 @endphp
                    @foreach($products as $product)
                    @php $total = $total + $product->quantity @endphp
                        <tr align="center">
                            <td>
                                {{$i}}
                            </td>
                            <td>
                                {{$product->name}}
                            </td>
                            <td>
                                {{$product->quantity}} @lang('panel.items')
                            </td>
                        </tr>
                    @php $i++ @endphp
                    @endforeach
                        <tr align="center">
                        <td></td>
                        <td><b>Total = </b></td>
                        <td><b>{{$total}} @lang('panel.items')</b></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrder', '',['id'=>'typeOrder']) !!}
                    <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('panel.ok_close')</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach($guest_orders as $order)
    <div class="modal" tabindex="-1" role="dialog" id="Order_guest-{{$order->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> @lang('panel.order_status')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4> @lang('panel.order_details')</h4>
                <p> @lang('panel.following')</p>
                <p><b> @lang('panel.client'): {{$order->fname . ' ' . $order->lname}}</b><p>
                <table class="table_products">
                <thead>
                <tr align="center">
                    <th>#   </th>
                    <th> @lang('panel.product_name')</th>
                    <th> @lang('panel.amount')</th>
                </tr>
                </thead>
                <tbody>
                @php $products = (json_decode($order->products)); $i=1; $total=0 @endphp
                @foreach($products as $product)
                @php $total = $total + $product->quantity @endphp
                    <tr align="center">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            {{$product->quantity}}  @lang('panel.items')
                        </td>
                    </tr>
                @php $i++ @endphp
                @endforeach
                    <tr align="center">
                    <td></td>
                    <td><b>Total = </b></td>
                    <td><b>{{$total}}  @lang('panel.items')</b></td>
                    </tr>
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                {!! Form::hidden('typeOrder', '',['id'=>'typeOrder']) !!}
                <button type="button" class="btn btn-primary" data-dismiss="modal"> @lang('panel.ok_close')</button>
            </div>
            </div>
        </div>
    </div>
@endforeach

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="fa fa-list"></i> @lang('panel.storage_control') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6" align="right">
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
                                        {!! Form::select('status', ['0'=>trans('panel.select_one'),'1'=>trans('panel.supply'),'2'=>trans('panel.report')], 0, ['class'=>'form-control','id'=>'user_order-'.$order->id]) !!}
                                    </td>
                                    <td>
                                        {{$order->user->name}}
                                    </td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
                                    <td>
                                      <button class="btn btn-success" data-toggle="modal" data-target={{"#Order_user-" . $order->id}}>
                                      <i class="fas fa-eye"></i>
                                      @lang('panel.see_details')</button>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($guest_orders as $order)
                            <tr align="center">
                                <td>
                                    {{$order->id}}
                                </td>
                                <td>
                                    <select name="" id={{"selectStatus-".$order->id}} onchange="changeStatusGuest({{$order->id}})" class="form-control">
                                        <option value="0">@lang('panel.select_one')</option>
                                        <option value="1">@lang('panel.supply')</option>
                                        <option value="2">@lang('panel.report')</option>
                                    </select>
                                    {{-- {!! Form::select('status', ['0'=>'','1'=>'','2'=>''], 0, ['class'=>'form-control','id'=>'guest_order','onChange'=>'changeStatusGuest({{$order->id}})']) !!}
                                </td>
                                <td>
                                    {{$order->fname }} {{ $order->lname }}
                                </td>
                                <td>
                                    {{$order->created_at}}
                                </td>
                                <td>
                                  <button class="btn btn-success" data-toggle="modal" data-target={{"#Order_guest-" . $order->id}}>
                                  <i class="fas fa-eye"></i>
                                  @lang('panel.see_details')</button>
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

        function changeStatusGuest(id){
            var status = $('#selectStatus-'+id).val();
            if(status == 1){
                $('#Pedido').text(id);
                $('#typeOrder').val('G');
                $('#myModalSurtido').modal('show');
            }else if(status == 2){
                $('#myModalReporte').modal('show');
                $('#Pedido1').text(id);
            }
        }

        $('#confirmar').on('click',function(){

            var data = {
                'id' : $('#Pedido').text(),
                'type' : $('#typeOrder').val(),
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/confirmationWarehouse')}}",data,function(dato){
                $("#select option[value="+dato+"]").attr('selected', 'selected');
                $('#myModalSurtido').modal('hide');
            })
        })
    </script>
@endpush

@endsection --}}

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
            <h4 class="card-title mb-0"><i class="fa fa-warehouse"></i> @lang('panel.storage_control') </h4>
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
                                <th>Estatus</th>
                                <th>Usuario</th>
                                <th>Fecha de Compra</th>
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
                                            {!! Form::select('status', ['0'=>'Selecciona uno','1'=>'Surtido','2'=>'Reportar'], $order->status, ['class'=>'form-control','id'=>'selectStatusUSer','onChange'=>'changeStatusUser('.$order->id.')']) !!}
                                        @else
                                            {!! Form::select('status', ['0'=>'Selecciona uno','1'=>'Surtido','2'=>'Reportar'], 0, ['class'=>'form-control','id'=>'selectStatusUSer','onChange'=>'changeStatusUser('.$order->id.')']) !!}
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
                                            {!! Form::select('status', ['0'=>'Selecciona uno','1'=>'Surtido','2'=>'Reportar'], $order->status, ['class'=>'form-control','id'=>'selectStatus','onChange'=>'changeStatusGuest('.$order->id.')']) !!}
                                        @else
                                            {!! Form::select('status', ['0'=>'Selecciona uno','1'=>'Surtido','2'=>'Reportar'], 0, ['class'=>'form-control','id'=>'selectStatus','onChange'=>'changeStatusGuest('.$order->id.')']) !!}
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
        {{-- modal detalle Guest --}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="detalleModalGuest">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detalle de la orden </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" >
                    <p>Este es el detalle de la orden que seleccionaste</p>
                  <div id="orderDetailGuest"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                  {{-- <button type="button" class="btn btn-secondary" >Close</button> --}}
                </div>
              </div>
            </div>
        </div>
        {{-- modal detalle User--}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="detalleModalUser">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle de la orden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <p>Este es el detalle de la orden que seleccionaste</p>
                    <div id="orderDetailUser">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    {{-- <button type="button" class="btn btn-secondary" >Close</button> --}}
                </div>
                </div>
            </div>
        </div>
        {{-- modal empaquetado --}}
        <div class="modal" tabindex="-1" role="dialog" id="myModalSurtido">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirmar empaquetado</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Quieres confirmar el empaquetado del pedido con id: <label id="Pedido"></label>
                  </p>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrder', '',['id'=>'typeOrder']) !!}
                  <button type="button" class="btn btn-primary" id="confirmar">Confirmar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="myModalReporte">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reportar Pedido</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Describe el problema del pedido <label id="PedidoR"></label></p>
                  <textarea name="textArea" id="textArea" cols="30" style="resize: none" rows="10" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrder', '',['id'=>'typeOrderR']) !!}
                  <button type="button" class="btn btn-primary" id="reportar">Reportar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
        {{-- Modal usuario --}}
        <div class="modal" tabindex="-1" role="dialog" id="myModalSurtidoU">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirmar empaquetado</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Quieres confirmar el empaquetado del pedido con id: <label id="PedidoU"></label>
                  </p>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrderU', '',['id'=>'typeOrderU']) !!}
                  <button type="button" class="btn btn-primary" id="confirmarU">Confirmar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="myModalReporteU">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reportar Pedido</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Describe el problema del pedido <label id="PedidoRU"></label></p>
                  <textarea name="textArea" id="textArea" cols="30" style="resize: none" rows="10" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrderU', '',['id'=>'typeOrderRU']) !!}
                  <button type="button" class="btn btn-primary" id="reportarU">Reportar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

        function changeStatusGuest(id){
            var status = $('#selectStatus').val();
            if(status == 1){
                $('#Pedido').text(id);
                $('#typeOrder').val('G');
                $('#myModalSurtido').modal('show');
            }else if(status == 2){
                $('#PedidoR').text(id);
                $('#typeOrderR').val('G');
                $('#myModalReporte').modal('show');
            }
        }
        $('#confirmar').on('click',function(){

            var data = {
                'id' : $('#Pedido').text(),
                'type' : $('#typeOrder').val(),
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/confirmationWarehouse')}}",data,function(dato){
                $('#myModalSurtido').modal('hide');
            })
        })
        $('#reportar').on('click',function(){

            var data = {
                'id' : $('#PedidoR').text(),
                'type' : $('#typeOrderR').val(),
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/reportarWarehouse')}}",data,function(dato){
                $('#myModalReporte').modal('hide');
            })
        })
        function changeStatusUser(id){
            var status = $('#selectStatusUSer').val();
            // alert(status)
            if(status == 1){
                $('#PedidoU').text(id);
                $('#typeOrderU').val('U');
                $('#myModalSurtidoU').modal('show');
            }else if(status == 2){
                $('#PedidoRU').text(id);
                $('#typeOrderRU').val('U');
                $('#myModalReporteU').modal('show');
            }
        }
        $('#confirmarU').on('click',function(){
            // alert($('#typeOrderU').val())
            var data = {
                'id' : $('#PedidoU').text(),
                'type' : $('#typeOrderU').val(),
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/confirmationWarehouse')}}",data,function(dato){
                $('#myModalSurtidoU').modal('hide');
            })
        })
        $('#reportarU').on('click',function(){

            var data = {
                'id' : $('#PedidoRU').text(),
                'type' : $('#typeOrderRU').val(),
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/reportarWarehouse')}}",data,function(dato){
                $('#myModalReporteU').modal('hide');
            })
        })
        $('#detalleModalGuest').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')

            var dato = {
                'id' : recipient,
            }
            $.get('{{ url("admin/getProductGuest")}}',dato,function(data){
                $('#orderDetailGuest').html(data);
            })
        })
        $('#detalleModalUser').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')

            var dato = {
                'id' : recipient,
            }
            $.get('{{ url("admin/getProductUser")}}',dato,function(data){
                $('#orderDetailUser').html(data);
            })
        })
    </script>
@endpush

@endsection
