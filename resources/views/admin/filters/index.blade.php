@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">Filtros</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fa fa-filter"></i> Filtros </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">Todos los filtros</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.filters.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> Nuevo filtro
                  </a>
              </div>
              <div class="col-md-12">
                    <br>
                  <div class="table-responsive p-t-10">
                    <table id="table-filters" class="table" style="width:100%;">
                        <thead>
                            <tr align="center">
                                <th># </th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($filters as $filter)
                            <tr align="center">
                                <td>{{ $filter->id }}</td>
                                <td>{{ $filter->name }}</td>
                                <td>{{ $filter->category }}</td>
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    <li class="list-inline-item">
                                      <a class="btn btn-success btn-sm" href="{{ route('admin.filters.edit', $filter->id) }}" title="{{ trans('Editar') }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    </li>
                                    <li class="list-inline-item">
                                      
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route('admin.filters.destroy', $filter->id),
                                          'method' => 'DELETE',
                                          ])
                                      !!}
                                          <button class="btn btn-danger btn-sm" title="{{ trans('Eliminar') }}"><i class="fas fa-trash-alt"></i></button>
                                      {!! Form::close() !!}
                                      
                                    </li>
                                  </ul>
                                </td>
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
        </div>
@push('script')
<script>
   @if(App::isLocale('es'))
        $('#table-filters').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-filters').DataTable({
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
