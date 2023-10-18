@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item">@lang('panel.home')</li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/discount') }}">@lang('panel.discount') </a></li>
    <li class="breadcrumb-item active">@lang('panel.edit')</li>
  </ol>

   {!! Form::model($discount, [
        'action' => ['DiscountController@update', $discount->id],
        'method' => 'put',
        'files' => true
      ])
    !!}

    @include('admin.discount.form')

    <div class="card-footer" align="center">
      <button class="btn btn-md btn-success" type="submit">
        <i class="fa fa-refresh"></i> @lang('panel.update')</button>
      <a href="{{ URL::previous() }}" class="btn btn-md btn-danger">
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
