{{-- @extends('admin.styles')

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
            <h4 class="card-title mb-0"><i class="fa fa-clock-o"></i> @lang('panel.storage_pendings') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                {{-- <h5 class="card-title mb-0">Almacén</h5>
              </div>
              <div class="col-md-6" align="right">
                {{--  <a href="{{ route('admin.warehouse.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> Nuevo Usuario
                  </a>
              </div>
              <div class="col-md-12">
                    <br>
                    <table id="table-warehouse" class="display">
                        <thead>
                            <tr align="center">
                                <th>@lang('panel.storage')</th>
                            </tr>
                        </thead>
                        <tbody>

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
            <h4 class="card-title mb-0"><i class="fa fa-warehouse"></i> @lang('panel.storage_pendings') </h4>
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
                                            <button class="btn btn-info" disabled>@lang('panel.supply')</button>
                                            {{-- {!! Form::select('status', ['0'=>'Selecciona uno','1'=>'Surtido','2'=>'Reportar'], $order->status, ['class'=>'form-control','id'=>'selectStatusUSer','onChange'=>')']) !!} --}}
                                        @else
                                            <button class="btn btn-warning" onclick="changeStatusUser('{{$order->id}}')">@lang('panel.do_supply')</button>
                                            {{-- {!! Form::select('status', ['0'=>'Selecciona uno','1'=>'Surtido','2'=>'Reportar'], 0, ['class'=>'form-control','id'=>'selectStatusUSer','onChange'=>'changeStatusUser('.$order->id.')']) !!} --}}
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
                                            <button class="btn btn-info" disabled>@lang('panel.supply')</button>
                                        @else
                                            <button class="btn btn-warning" onclick="changeStatusGuest('{{$order->id}}')">@lang('panel.do_supply')</button>
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
                  <h5 class="modal-title">@lang('panel.order_details')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" >
                    <p>@lang('panel.the_detail')</p>
                  <div id="orderDetailGuest"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('panel.accept')</button>
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
                    <h5 class="modal-title">@lang('panel.order_details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <p>@lang('panel.the_detail')</p>
                    <div id="orderDetailUser">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('panel.accept')</button>
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
                  <h5 class="modal-title">@lang('panel.confirm_pack')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>@lang('panel.want_confirm')<label id="Pedido"></label>
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
                  <h5 class="modal-title">@lang('panel.report_order')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>@lang('panel.describe_issue')<label id="PedidoR"></label></p>
                  <textarea name="textArea" id="textArea" cols="30" style="resize: none" rows="10" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrder', '',['id'=>'typeOrderR']) !!}
                  <button type="button" class="btn btn-primary" id="reportar">@lang('panel.report')</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.close')</button>
                </div>
              </div>
            </div>
        </div>
        {{-- Modal usuario --}}
        <div class="modal" tabindex="-1" role="dialog" id="myModalSurtidoU">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">@lang('panel.confirm_pack')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>@lang('panel.want_confirm')<label id="PedidoU"></label>
                  </p>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrderU', '',['id'=>'typeOrderU']) !!}
                  <button type="button" class="btn btn-primary" id="confirmarU">@lang('panel.confirm')</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.close')</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="myModalReporteU">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">@lang('panel.report_order')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>@lang('panel.describe_issue')<label id="PedidoRU"></label></p>
                  <textarea name="textArea" id="textArea" cols="30" style="resize: none" rows="10" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('typeOrderU', '',['id'=>'typeOrderRU']) !!}
                  <button type="button" class="btn btn-primary" id="reportarU">@lang('panel.report')</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.close')</button>
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
                location.reload();
            })
        })
        function changeStatusUser(id){
                $('#PedidoU').text(id);
                $('#typeOrderU').val('U');
                $('#myModalSurtidoU').modal('show');
        }
        $('#confirmarU').on('click',function(){
            // alert($('#typeOrderU').val())
            var data = {
                'id' : $('#PedidoU').text(),
                'type' : $('#typeOrderU').val(),
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/confirmationWarehouse')}}",data,function(){
                location.reload();
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
