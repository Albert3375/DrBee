@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ URL('admin/estafeta') }}">Guias</a></li>
    <li class="breadcrumb-item active">Editar</li>
  </ol>

    {!! Form::model($reference, [
        'action' => ['EstafetaController@update', $estafeta->id],
        'method' => 'put',
        'files' => true
      ])
    !!}

    @include('admin.estafeta.form')

    <div class="card-footer" align="right">
      <button class="btn btn-sm btn-success" type="submit">
        <i class="fa fa-check"></i> Guardar</button>
      <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-times"></i> Limpiar</button>
      <a href="{{ URL('admin/estafeta') }}" class="btn btn-sm btn-danger">
        <i class="fa fa-ban"></i> Regresar</a>
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
