@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.bank_references')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fa fa-dropbox"></i> @lang('panel.bank_references')</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">@lang('panel.all_bank_references')</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.references.create') }}" class="btn btn-info" style="color:#fff;">
                    <i class="fa fa-plus"></i> @lang('panel.new_reference')
                  </a>
              </div>
              <div class="col-md-12">
                    <br>
                    <table id="table-reference" class="display">
                        <thead>
                            <tr align="center">
                                <th>@lang('panel.bank')</th>
                                <th>@lang('panel.holder')</th>
                                <th>@lang('panel.type')</th>
                                <th>@lang('panel.reference')</th>
                                <th>@lang('panel.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($references as $reference)
                            <tr align="center">
                                <td>{{ $reference->bankAccount->name }} </td>
                                <td>{{ $reference->holder }}</td>
                                <td>{{ $reference->type }}</td>
                                <td>{{ $reference->references }}</td>
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    <li class="list-inline-item">
                                      <a class="btn btn-success btn-sm" href="{{ route('admin.references.edit', $reference->id) }}" title="{{ trans('panel.edit') }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    </li>
                                    <li class="list-inline-item">
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route('admin.references.destroy', $reference->id),
                                          'method' => 'DELETE',
                                          ])
                                      !!}
                                          <button class="btn btn-danger btn-sm" title="{{ trans('panel.delete') }}"><i class="fa fa-trash-o"></i></button>
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
    $('#table-reference').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         },
         "responsive": true,
         "bSort": false
    });
@else
   $('#table-reference').DataTable({
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
