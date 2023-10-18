@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/coupons') }}">Cupones</a></li>
    <li class="breadcrumb-item active">Editar cupón</li>
  </ol>

    {!! Form::model($coupon, [
        'action' => ['CouponController@update', $coupon->id],
        'method' => 'put',
        'files' => true
      ])
    !!}

    @include('admin.coupons.form')

    <div class="card-footer" align="right">
      <button class="btn btn-sm btn-success" type="submit">
        <i class="fa fa-check"></i> @lang('panel.save')</button>
      <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-times"></i> @lang('panel.clean')</button>

      <a href="{{ URL('admin/coupons') }}" class="btn btn-sm btn-danger">

        <i class="fa fa-ban"></i> @lang('panel.cancel')</a>
    </div>


  {!! Form::close() !!}

@push('script')

<script>
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });
</script>
@endpush

@endsection
