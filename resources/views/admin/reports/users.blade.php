@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.reports')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fa fa-file-pdf-o"></i> @lang('panel.reports') </h4>
          </div>
          <div class="card-body">
            <input id="data" style="display: none" type="text" >
            <form method="POST" action="/get_best_seller_products">
              @csrf
              <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title mb-0">Reporte de Clientes</h5>
                  </div>

                   <div class="col-md-12">
                    <br>
                    <table id="table-users" class="display">
                        <thead>
                            <tr align="center">
                                <th># @lang('panel.user')</th>
                                <th>@lang('panel.name')</th>
                                <th>@lang('panel.lastname')</th>
                                <th>@lang('panel.email')</th>
                                <th>@lang('panel.phone')</th>
                                <th>@lang('panel.role')</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                            <tr align="center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
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
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
      
            </form>
                    
              
                </div>
              </div>
            </div>
          </div>
        </div>
@push('script')

@php
  $path = public_path() . '/';
@endphp

<script>
   @if(App::isLocale('es'))
        $('#table-users').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            bSort: false
        });
    @else
       $('#table-users').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            bSort: false
        });
    @endif
</script>

@endpush

@endsection