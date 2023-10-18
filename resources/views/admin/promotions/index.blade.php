@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">Promociones</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fa fa-warning"></i> Promociones </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">Todas las promociones</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.promotions.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> Nueva promoción
                  </a>
              </div>
              <div class="col-md-12">
                    <br>
                    <table id="table-promotions" class="display">
                        <thead>
                            <tr align="center">
                                <th># </th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Vigencia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($promotions as $promotion)
                            <tr align="center">
                                <td>{{ $promotion->id }}</td>
                                <td>{{ $promotion->name }}</td>
                                <td>{{ $promotion->description }}</td>
                                @if($promotion->image != null)
                                <td>
                                    <img src="{{ URL($promotion->image) }}" style="width: auto !important; height: auto !important; max-width: 80%;">
                                </td>
                                @else
                                <td>
                                  @lang('panel.no_image')
                                </td>
                                @endif
                                <td>{{ $promotion->valitidy }}</td>
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    <li class="list-inline-item">
                                      <a class="btn btn-success btn-sm" href="{{ route('admin.promotions.edit', $promotion->id) }}" title="{{ trans('Editar') }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    </li>
                                    <li class="list-inline-item">
                                      
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route('admin.promotions.destroy', $promotion->id),
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
@push('script')
<script>
   @if(App::isLocale('es'))
        $('#table-promotions').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-promotions').DataTable({
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
