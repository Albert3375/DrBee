@extends('admin.styles')

@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Inicio</a></li>
  <li class="breadcrumb-item active">Guias</li>
</ol>

@include('flash::message')

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0"><i class="nav-icon fa fa-dropbox"></i> Guias de Estafeta</h4>
      </div>
      <div class="card-body">
        <div class="row">

          <div class="col-md-6">
            <h5 class="card-title mb-0">Todas las Guias</h5>
          </div>
          <div class="col-md-6" align="right">
            <a href="{{ route('admin.estafeta.create') }}" class="btn btn-info" style="color:#fff;">
              <i class="fa fa-plus"></i> Nueva Guia
            </a>
          </div>
          <div class="col-md-12">
            <br>
            <table id="table-estafeta" class="display">
              <thead>
                <tr align="center">
                  <th>ID</th>
                  <th>Dirección</th>
                  <th>Ciudad</th>
                  <th>Compañia</th>
                  <th>Colonia</th>
                  <th>Teléfono</th>
                  <th>Estado</th>
                  <th>CP</th>
                  <th>Celular</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($estafetas as $estafeta)
                <tr align="center">
                  <td>{{ $estafeta->id }} </td>
                  <td>{{ $estafeta->destination_info_addrees1 }}</td>
                  <td>{{ $estafeta->destination_info_city }}</td>
                  <td>{{ $estafeta->destination_info_corporateName }}</td>
                  <td>{{ $estafeta->destination_info_neighborhood }}</td>
                  <td>{{ $estafeta->destination_info_phoneNumber }}</td>
                  <td>{{ $estafeta->destination_info_state }}</td>
                  <td>{{ $estafeta->destination_info_zipCode }}</td>
                  <td>{{ $estafeta->destination_info_CellPhone }}</td>
                  <td>
                    <li class="list-inline-item">
                      <a class="btn btn-warning btn-sm" target="_BLANK" href="/admin/createguide/{{ $estafeta->id }}"
                        title="{{ trans('Crear guía') }}">
                        <i class="far fa-file-alt"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a class="btn btn-success btn-sm" href="{{ route('admin.estafeta.edit', $estafeta->id) }}"
                        title="{{ trans('Editar') }}">
                        <i class="fa fa-pencil"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      {!! Form::open([
                      'class'=>'delete',
                      'url' => route('admin.estafeta.destroy', $estafeta->id),
                      'method' => 'DELETE',
                      ])
                      !!}
                      <button class="btn btn-danger btn-sm" title="{{ trans('Eliminar') }}"><i
                          class="fa fa-trash-o"></i></button>
                      {!! Form::close() !!}
                    </li>
                  </td>
                  <td></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push('script')
<script>
  @if(App::isLocale('es'))
    $('#table-estafeta').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         },
         "responsive": true,
         "bSort": false
    });
@else
   $('#table-estafeta').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
         },
         "responsive": true,
         "bSort": false
   });
@endif
</script>
@endpush

@endsection