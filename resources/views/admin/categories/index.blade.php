@extends('admin.styles')

@section('content')

<style>
/* Estilo para centrar contenido y dar espacio a los botones */
.container {
    background-color: #f5f5f5; /* Color de fondo gris claro */
    border: 1px solid #3498db; /* Borde azul claro */
    border-radius: 10px; /* Borde redondeado */
    padding: 20px; /* Espaciado interno del contenedor */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.container h1 {
    color: #3498db; /* Color de texto azul */
}

/* Estilo para resaltar botones dentro del contenedor */
.container .btn {
    background-color: #3498db; /* Fondo azul para el botón */
    color: #ffffff; /* Texto blanco para el botón */
    border: none;
    border-radius: 3px;
    padding: 15px 30px; /* Aumento del espacio en los botones */
    margin: 10px 0; /* Espaciado entre los botones */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Transición de color de fondo al pasar el mouse */
}

.container .btn:hover {
    background-color: #2980b9; /* Cambio de color de fondo del botón al pasar el mouse */
}

</style>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.categories')</li>
  </ol>

  @include('flash::message')

  <div class="container">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fas fa-university"></i> @lang('panel.categories') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">@lang('panel.all_categories')</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.categories.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> @lang('panel.new_category')
                  </a>
              </div>
              <div class="col-md-12">
                <br>
                <div class="table-responsive p-t-10">
                <table id="table-users" class="display compact" style="width:100%">
                      <thead>
                          <tr align="center">
                              <th>ID</th>
                              <th>@lang('panel.name')</th>
                            
                              <th>@lang('panel.register_date')</th>
                              <th>@lang('panel.actions')</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($categories as $category)
                              <tr align="center">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                           
                                <td>{{ $category->created_at }}</td>
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    <li class="list-inline-item">
                                      <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.edit', $category->id) }}" title="{{ trans('panel.edit') }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target={{"#Modal-" . $category->id}}><i class="fa fa-trash-o"></i></button>

                                        <div class="modal fade" id={{"Modal-" . $category->id}} role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">@lang('panel.important')</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                 <p>@lang('panel.category_sentence_1')</p>
                                                    <p>@lang('panel.category_sentence_2')</p>
                                                    <p>@lang('panel.confirm_action')</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.cancel')</button>
                                                  {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route('admin.categories.destroy', $category->id),
                                                    'method' => 'DELETE',
                                                    ])
                                                !!}
                                                    <button title="{{ trans('panel.delete') }}" class="btn btn-danger">@lang('panel.delete')</button>
                                                {!! Form::close() !!}

                                                </div>
                                              </div>
                                            </div>
                                          </div>
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


  <script>
     @if(App::isLocale('es'))
          $('#table-categories').DataTable({
              "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
               },
               "responsive": true,
                "dom": 'Bfrtip',
              "bSort": false,
              "buttons": [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });
      @else
         $('#table-categories').DataTable({
              "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json"
               },
               "responsive": true,
              "dom": 'Bfrtip',
              "bSort": false,
              "buttons": [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
         });
      @endif
  </script>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">



<script>
    $(document).ready(function() {
        $('#table-users').DataTable({
            stateSave: true
        });
    });
</script>



@endsection
