@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/adresses') }}">@lang('panel.addresses')</a></li>
    <li class="breadcrumb-item active">@lang('panel.new_address')</li>
  </ol>

    {!! Form::open([
        'action' => ['AdressesController@store'],
      ])
    !!}

    @include('admin.adresses.form')

    <div class="card-footer" align="right">
      <button class="btn btn-sm btn-success" type="submit">
        <i class="fa fa-check"></i> @lang('panel.save')</button>
      <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-times"></i> @lang('panel.clean')</button>
      <a href="{{ URL('admin/adresses') }}" class="btn btn-sm btn-danger">
        <i class="fa fa-ban"></i> @lang('panel.cancel')</a>
    </div>

  {!! Form::close() !!}

@push('script')
@endpush

@endsection
