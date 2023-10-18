@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item">@lang('panel.home')</li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/discount') }}">@lang('panel.discount')</a></li>
    <li class="breadcrumb-item active">@lang('panel.new_discount')</li>
  </ol>

    {!! Form::open([
        'action' => ['NewsController@store'],
        'files' => true
      ])
    !!}

    @include('admin.news.form')

    <div class="card-footer" align="right">
      <button class="btn btn-sm btn-success" type="submit">
        <i class="fa fa-dot-circle-o"></i> @lang('panel.save')</button>
      <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-ban"></i> @lang('panel.delete')</button>
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-danger">
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
