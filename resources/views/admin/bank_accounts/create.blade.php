@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/bank_accounts') }}">@lang('panel.bank_accounts')</a></li>
    <li class="breadcrumb-item active">@lang('panel.new_bank')</li>
  </ol>

    {!! Form::open([
        'action' => ['BankAccountsController@store']
      ])
    !!}

    @include('admin.bank_accounts.form')

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