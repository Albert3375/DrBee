@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('/admin/payments') }}">@lang('panel.my_payment_methods')</a></li>
    <li class="breadcrumb-item active">@lang('panel.new_payment_method')</li>
  </ol>

  @include('flash::message')

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div id="add-card-form" user_id="{{Auth::user()->id}}"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>

@endsection
