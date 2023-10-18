@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.monthly_sales')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon icon-people"></i> >@lang('panel.monthly_sales') </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">>@lang('panel.all_monthly_sales')</h5>
              </div>
              <div class="col-md-6" align="right">
                <a href="{{ route('admin.reporter.create') }}" class="btn btn-success" style="color:#fff;">
                   <i class="fa fa-plus"></i> >@lang('panel.generate')
                 </a>
              </div>
              <div class="col-md-12">
                    <br>
                    <table id="table-reports" class="display">
                        <thead>
                            <tr align="center">
                                <th>>@lang('panel.actions')</th>
                            </tr>
                        </thead>
                        <tbody>

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
        $('#table-reports').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-reports').DataTable({
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
