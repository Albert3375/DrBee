@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/users') }}">Promociones</a></li>
    <li class="breadcrumb-item active">Editar promoción</li>
  </ol>

    {!! Form::model($promotion, [
        'action' => ['PromotionController@update', $promotion->id],
        'method' => 'put',
        'files' => true
      ])
    !!}

    @include('admin.promotions.form')

    <div class="card-footer" align="right">
      <button class="btn btn-sm btn-success" type="submit">
        <i class="fa fa-check"></i> @lang('panel.save')</button>
      {{-- <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-times"></i> Borrar</button> --}}
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-danger">
        <i class="fa fa-ban"></i> @lang('panel.back')</a>
    </div>


  {!! Form::close() !!}

@push('script')
@endpush

@endsection
