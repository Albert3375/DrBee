@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/conciliations') }}">Conciliaciones</a></li>
    <li class="breadcrumb-item active">Editar</li>
  </ol>

    {!! Form::model($conciliation, [
        'action' => ['ConciliationsController@update', $conciliation->id],
        'method' => 'put',
        'files' => true
      ])
    !!}

    @include('admin.conciliations.form')

    <div class="card-footer" align="right">
      <button class="btn btn-sm btn-success" type="submit">
        <i class="fa fa-check"></i> Guardar</button>
      {{-- <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-times"></i> Limpiar</button> --}}
      <a href="{{ URL('admin/conciliations') }}" class="btn btn-sm btn-danger">
        <i class="fa fa-ban"></i> Cancelar</a>
    </div>

  {!! Form::close() !!}

@push('script')
@endpush

@endsection
