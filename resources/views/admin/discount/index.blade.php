@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item">@lang('panel.home')</li>
    <li class="breadcrumb-item active">@lang('panel.discount') </li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="card">
              <div class="card-body">
                <br>
                <div class="row">
                  <div class="col-lg-12" align="center">
                    <div class="card">
                      <div class="card-header" align="center">
                        <h3>
                          @lang('panel.discount') <i class="fa fa-percent" aria-hidden="true"></i>
                        </h3>
                      </div>
                      <div class="card-body">

                      <h2>@lang('panel.discount_amount'){{ $discount->value }}%</h2>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12" align="center">
                      <a href="{{ route('admin.discount.edit', $discount->id) }}" class="btn btn-success">
                        <i class="fa fa-refresh"></i> @lang('panel.update') @lang('panel.discount')
                        </a>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
@push('script')
<script>
   @if(App::isLocale('es'))
        $('#table-discount').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-discount').DataTable({
        responsive: true
       });
    @endif
</script>
@endpush

@endsection
