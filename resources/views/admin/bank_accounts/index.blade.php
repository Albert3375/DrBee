@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.bank_accounts')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fas fa-university"></i> @lang('panel.bank_accounts') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">@lang('panel.all_bank_accounts')</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.bank_accounts.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> @lang('panel.new_bank')
                  </a>
              </div>
              <div class="col-md-12">
                <br>
                <table id="table-bank_accounts" class="display">
                    <thead>
                        <tr align="center">
                            <th>@lang('panel.bank_id')</th>
                            <th>@lang('panel.bank_name')</th>
                            <th>@lang('panel.register_date')</th>
                            <th>@lang('panel.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($bank_accounts as $bank_account)
                            <tr align="center">
                            <td>{{ $bank_account->id }}</td>
                            <td>{{ $bank_account->name}}</td>
                            <td>{{ $bank_account->created_at }}</td>
                            <td>
                              <ul class="list-inline" style="margin: 0px;">
                                <li class="list-inline-item">
                                  <a class="btn btn-primary btn-sm" href="{{ route('admin.bank_accounts.edit', $bank_account->id) }}" title="{{ trans('Editar') }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash-o"></i></button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">@lang('panel.important')</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                             <p>@lang('panel.reference_sentence_1')</p>
                                                <p>@lang('panel.reference_sentence_2')</p>
                                                <p>@lang('panel.confirm_action')</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('panel.cancel')</button>
                                                {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route('admin.bank_accounts.destroy', $bank_account->id),
                                                    'method' => 'DELETE',
                                                    ])
                                                    !!}
                                                    <button title="{{ trans('panel.delete')}}" class="btn btn-danger">@lang('panel.delete')</button>
                                                {!! Form::close() !!}
                                            </div>
                                          </div>
                                        </div>
                                      </div>
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
        $('#table-bank_accounts').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-bank_accounts').DataTable({
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
