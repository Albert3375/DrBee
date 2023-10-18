@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.references')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fab fa-cc-visa"></i> @lang('panel.references') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">@lang('panel.all_references')</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.bank_accounts.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> @lang('panel.new_reference')
                  </a>
              </div>
              <div class="col-md-12">
                <br>
                <table id="table-bank_accounts_references" class="display">
                    <thead>
                        <tr align="center">
                            <th>@lang('panel.reference_id')</th>
                            <th>@lang('panel.bank_id')</th>
                            <th>@lang('panel.holder_name')</th>
                            <th>@lang('panel.reference_type')</th>
                            <th>@lang('panel.reference_no')</th>
                            <th>@lang('panel.register_date')</th>
                            <th>@lang('panel.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($bank_accounts_references as $bank_account_reference)
                            <tr align="center">
                            <td>{{ $bank_account_reference->idReferencia }}</td>
                            <td>{{ $bank_account_reference->idBanco }}</td>
                            <td>{{ $bank_account_reference->nombreTitular }}</td>
                            <td>{{ $bank_account_reference->tipoReferencia }}</td>
                            <td>{{ $bank_account_reference->numeroReferencia }}</td>
                            <td>{{ $bank_account_reference->fechaRegistro }}</td>
                            <td>
                              <ul class="list-inline" style="margin: 0px;">
                                <li class="list-inline-item">
                                  <a class="btn btn-primary btn-sm" href="{{ route('admin.bank_accounts.edit', $bank_account_reference->idReferencia) }}" title="{{ trans('panel.edit') }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                </li>
                                <li class="list-inline-item">
                                  {!! Form::open([
                                      'class'=>'delete',
                                      'url'  => route('admin.bank_accounts.destroy', $bank_account_reference->idReferencia),
                                      'method' => 'DELETE',
                                      ])
                                  !!}
                                      <button class="btn btn-danger btn-sm" title="{{ trans('panel.delete') }}"><i class="fas fa-trash-alt"></i></button>
                                  {!! Form::close() !!}
                                </li>
                              </ul>
                            </td>
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
        $('#table-bank_accounts_references').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-bank_accounts_references').DataTable({
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
