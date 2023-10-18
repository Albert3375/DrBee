@extends('admin.styles')

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
        <li class="breadcrumb-item active">@lang('panel.price_rules')</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title mb-0"><i class="nav-icon fa fa-usd"></i> @lang('panel.price_rules')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <h5 class="card-title mb-0">@lang('panel.settings')</h5>
                        </div>
                        <div class="col-md-12"><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('',  trans('panel.amount_package')) !!}
                                        {!! Form::number('CantidadPiezasPaquete', $priceRule->quantityPerPackage, ['class'=>'form-control','id'=>'CantidadPiezasPaquete']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('',  trans('panel.unit_price')) !!}
                                        {!! Form::number('CostoPorPieza', $priceRule->unitPrice, ['class'=>'form-control','id'=>'CostoPorPieza']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('', trans('panel.discount')) !!}
                                        {!! Form::number('Descuento', $priceRule->Discount ,['class'=>'form-control','id'=>'Descuento']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="PrecioConDescuento">
                                        {!! Form::label('', trans('panel.cost_discount')) !!}
                                        {!! Form::number('PrecioConDescuento', $priceRule->priceDiscount, ['class'=>'form-control','disabled']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="PrecioPaqueteConDesc">
                                        {!! Form::label('', trans('panel.package_discount')) !!}
                                        {!! Form::number('PrecioPaqueteConDesc', $priceRule->packageDiscount, ['class'=>'form-control','disabled']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id='PrecioPaquete'>
                                        {!! Form::label('', trans('panel.cost_no_discount')) !!}
                                        {!! Form::number('PrecioPaquete', $priceRule->packagePrice, ['class'=>'form-control','disabled']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="AhorroCompra" >
                                        {!! Form::label('',trans('panel.purchase_saving')) !!}
                                        {!! Form::number('AhorroCompra', $priceRule->savedPurchase, ['class'=>'form-control','disabled']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('', trans('panel.delivery_saving')) !!}
                                        {!! Form::number('AhorroEnvio', $priceRule->savedShipping, ['class'=>'form-control','id'=>'AhorroEnvio']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="TotalAhorrado">
                                        {!! Form::label('', trans('panel.total_saved')) !!}
                                        {!! Form::number('TotalAhorrado',  $priceRule->savedTotal, ['class'=>'form-control','disabled']) !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="form-group" id="CostoPiezaSin">
                                        {!! Form::label('', trans('panel.cost_no_discount')) !!}
                                        {!! Form::number('CostoPiezaSin', $priceRule->costPieceWithoutDiscount, ['class'=>'form-control','disabled']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="CostoPiezaCon">
                                        {!! Form::label('', trans('panel.cost_discount')) !!}
                                        {!! Form::number('CostoPiezaCon', $priceRule->costPieceWithDiscount, ['class'=>'form-control','disabled']) !!}
                                    </div>
                                </div>--}}
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        {!! Form::label('', trans('panel.category')) !!}
                                       {!! Form::select('Category', $categories, $priceRule->category_id, ['class'=>'form-control','id'=>'Category']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12" align="center">
                             <a href="{{ url('admin/indexRules')}}" class="btn btn-success" style="color:#fff;">
                                <i class="fa fa-check"></i> @lang('panel.save')
                             </a>
                             {!! Form::hidden('id', $priceRule->id, ['id'=>'id']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  @include('flash::message')
  @push('script')
    <script>
        $('#CantidadPiezasPaquete').change(function(){
            var data = {
                'id' : $('#id').val(),
                'CantidadPiezasPaquete' : $('#CantidadPiezasPaquete').val(),
                'var' : 'CantidadPiezasPaquete',
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/updatePriceRule')}}",data,function(dato){
                $('#PrecioConDescuento').load(window.location.href + ' #PrecioConDescuento');
                $('#PrecioPaqueteConDesc').load(' #PrecioPaqueteConDesc');
                $('#PrecioPaquete').load(' #PrecioPaquete');
                $('#AhorroCompra').load(' #AhorroCompra');
                $('#TotalAhorrado').load(' #TotalAhorrado');
            })
        })
        $('#CostoPorPieza').change(function(){
            // alert( $('#id').val())
            var data = {
                'id' : $('#id').val(),
                'CostoPorPieza' : $('#CostoPorPieza').val(),
                'var' : 'CostoPorPieza',
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/updatePriceRule')}}",data,function(dato){
                $('#PrecioConDescuento').load(window.location.href + ' #PrecioConDescuento');
                $('#PrecioPaqueteConDesc').load(' #PrecioPaqueteConDesc');
                $('#PrecioPaquete').load(' #PrecioPaquete');
                $('#AhorroCompra').load(' #AhorroCompra');
                $('#TotalAhorrado').load(' #TotalAhorrado');
            })
        })
        $('#Descuento').change(function(){
            var data = {
                'id' : $('#id').val(),
                'Descuento' : $('#Descuento').val(),
                'var' : 'Descuento',
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/updatePriceRule')}}",data,function(dato){
                $('#PrecioConDescuento').load(window.location.href + ' #PrecioConDescuento');
                $('#PrecioPaqueteConDesc').load(' #PrecioPaqueteConDesc');
                $('#PrecioPaquete').load(' #PrecioPaquete');
                $('#AhorroCompra').load(' #AhorroCompra');
                $('#TotalAhorrado').load(' #TotalAhorrado');
            })
        })
        $('#AhorroEnvio').change(function(){
            var data = {
                'id' : $('#id').val(),
                'AhorroEnvio' : $('#AhorroEnvio').val(),
                'var' : 'AhorroEnvio',
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/updatePriceRule')}}",data,function(dato){
                $('#PrecioConDescuento').load(window.location.href + ' #PrecioConDescuento');
                $('#PrecioPaqueteConDesc').load(' #PrecioPaqueteConDesc');
                $('#PrecioPaquete').load(' #PrecioPaquete');
                $('#AhorroCompra').load(' #AhorroCompra');
                $('#TotalAhorrado').load(' #TotalAhorrado');
            })
        })
        // $('#PorcentajeDescuento').change(function(){
        //     // alert( $('#id').val())
        //     var data = {
        //         'id' : $('#id').val(),
        //         'PorcentajeDescuento' : $('#PorcentajeDescuento').val(),
        //         'var' : 'PorcentajeDescuento',
        //         '_token' : '{{ csrf_token() }}',
        //     }

        //     $.post("{{ url('admin/updatePriceRule')}}",data,function(dato){
        //         $('#CostoPaquete').load(' #CostoPaquete');
        //         $('#TotalEnvio').load(' #TotalEnvio');
        //         $('#CostoPaqueteMasEnvio').load(' #CostoPaqueteMasEnvio');
        //         $('#TotalCostoPaqueteDesc').load(' #TotalCostoPaqueteDesc');
        //         $('#CostoPiezaSin').load(' #CostoPiezaSin');
        //         $('#CostoPiezaCon').load(' #CostoPiezaCon');
        //     })
        // })
        $('#Category').change(function(){
            var data = {
                'id' : $('#id').val(),
                'Category' : $('#Category').val(),
                'var' : 'Category',
                '_token' : '{{ csrf_token() }}',
            }

            $.post("{{ url('admin/updatePriceRule')}}",data,function(dato){

            })
        })
    </script>
  @endpush

  @endsection
