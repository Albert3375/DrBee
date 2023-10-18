@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">Cupones</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fa fa-gift"></i> Cupones de descuento</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">Todos los cupones de descuento</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.coupons.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> Nuevo Cupón
                  </a>
              </div>
              <div class="col-md-12">
                <br>
                <div class="table-responsive p-t-10">
                    <table id="table-coupons" class="table" style="width:100%;">
                      <thead>
                          <tr align="center">
                          	<th>ID</th>
                            <th>Nombre</th> 
                            <th>Categoría</th> 
                            <th>Duración</th> 
                            <th>Cantidad</th> 
                            <th>Validación</th> 
                            <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($coupons as $coupon)
                              <tr align="center">
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->category }}</td>
                                <td>${{ $coupon->quantity }}</td>
                                <td>{{ $coupon->validation }}</td>
                                @if($coupon->is_active === '1')
                                	<td>Vigente</td>
                                @else
                                	<td>Vencido</td>
                                @endif
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    {{-- <li class="list-inline-item">
                                      <a class="btn btn-primary btn-sm" href="{{ route('admin.coupons.edit', $coupon->id) }}" title="{{ trans('panel.edit') }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    </li> --}}
                                    <li class="list-inline-item">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target={{"#Modal-" . $coupon->id}}><i class="fa fa-trash-o"></i></button>

                                        <div class="modal fade" id={{"Modal-" . $coupon->id}} role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header" align="center">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Cupón</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                 <p>Eliminar Cupón</p>
                                                    <p>Se eliminará el cupón permanentemente, pero se podrán crear nuevos.</p>
                                                    <p>@lang('panel.confirm_action')</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.cancel')</button>
                                                  {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route('admin.coupons.destroy', $coupon->id),
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

@push('script')
  <script>
     @if(App::isLocale('es'))
          $('#table-coupons').DataTable({
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
         $('#table-coupons').DataTable({
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
  @endpush

@endsection
