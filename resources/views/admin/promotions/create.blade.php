@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/users') }}">Promociones</a></li>
    <li class="breadcrumb-item active">Nueva promoción</li>
  </ol>

    {!! Form::open([
        'action' => ['PromotionController@store'],
        'files' => true
      ])
    !!}

    @include('admin.promotions.form')

    <div class="card-footer" align="right">
      <button class="btn btn-sm btn-success" type="submit">
        <i class="fa fa-check"></i> @lang('panel.save')</button>
      <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-times"></i> @lang('panel.delete')</button>
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-danger">
        <i class="fa fa-ban"></i> @lang('panel.cancel')</a>
    </div>

  {!! Form::close() !!}

@push('script')
@endpush

@endsection
