@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.users')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon icon-people"></i> @lang('panel.users') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">@lang('panel.all_users')</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.users.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> @lang('panel.new_user')
                  </a>
              </div>
              <div class="col-md-12">
                  <div class="table-responsive col-md-12" align="center">
                      <br>
                      <table id="table-users" class="display" width="100%">
                        <thead>
                            <tr align="center">
                                <th># @lang('panel.user')</th>
                                <th>@lang('panel.name')</th>
                                <th>@lang('panel.lastname')</th>
                                <th>@lang('panel.email')</th>
                                <th>@lang('panel.phone')</th>
                                <th>@lang('panel.role')</th>
                                <th>@lang('panel.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                            <tr align="center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                @if($user->hasRole('admin'))
                                  <td>@lang('panel.admin')</td>
                                @elseif($user->hasRole('user'))
                                  <td>@lang('panel.user')</td>
                                @elseif($user->hasRole('manager'))
                                  <td>@lang('panel.manager')</td>
                                @elseif($user->hasRole('administrative'))
                                  <td>@lang('panel.administrative')</td>
                                @elseif($user->hasRole('accountant'))
                                  <td>@lang('panel.accountant')</td>
                                @elseif($user->hasRole('seller'))
                                  <td>@lang('panel.seller')</td>
                                @elseif($user->hasRole('warehouse'))
                                  <td>@lang('panel.warehouse')</td>
                                @endif
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    <li class="list-inline-item">
                                      <a class="btn btn-success btn-sm" href="{{ route('admin.users.edit', $user->id) }}" title="{{ trans('Editar') }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    </li>
                                 @if($user->id == $myid)
                                 @else
                                    <li class="list-inline-item">
                                      
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route('admin.users.destroy', $user->id),
                                          'method' => 'DELETE',
                                          ])
                                      !!}
                                          <button class="btn btn-danger btn-sm" title="{{ trans('Eliminar') }}"><i class="fas fa-trash-alt"></i></button>
                                      {!! Form::close() !!}
                                      
                                    </li>
                                  @endif
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
      @if (\App::isLocale('es'))
          $("#table-users").DataTable({
              "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json"
              },
              "responsive": true,
              "bSort": false,
              "dom": 'Bfrtip',
              "buttons": [
                  'csv', 'excel', 'pdf', 'print'
              ]
          });
      @else
          $('#table-users').DataTable({
              "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json"
              },
              "responsive": true,
              "bSort": false,
              "dom": 'Bfrtip',
              "buttons": [
                  'csv', 'excel', 'pdf', 'print'
              ]
          });
      @endif
  </script>
@endpush

@endsection
