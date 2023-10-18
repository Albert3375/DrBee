@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/users') }}">@lang('panel.users')</a></li>
    <li class="breadcrumb-item active">@lang('panel.edit')</li>
  </ol>

    {!! Form::model($user, [
        'action' => ['UsersController@update', $user->id],
        'method' => 'put',
        'files' => true
      ])
    !!}

    @include('admin.users.form')

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
