@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.price_rules')</li>
  </ol>
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-0"><i class="nav-icon fa fa-usd"></i> @lang('panel.price_rules')</h4>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              @include('flash::message')
              <h5 class="card-title mb-0"></h5>
            </div>
            <div class="col-md-12">
                  <br>
                  <div class="table-responsive p-t-10">
                        <table id="table-rules" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('panel.category')</th>
                                    <th>@lang('panel.pieces')</th>
                                    <th>@lang('panel.unit_price')</th>
                                    <th>@lang('panel.percent_discount')</th>
                                    <th>@lang('panel.piece_discount')</th>
                                    {{-- <th>@lang('panel.package') + @lang('panel.delivery')</th> --}}
                                    {{-- <th>Costo de envío por libra</th>
                                    <th>Costo por libra de envío</th> --}}
                                    <th>@lang('panel.package_discount')</th>
                                    <th>@lang('panel.cost_no_discount')</th>
                                    {{-- <th>Costo de pieza con desc.</th> --}}
                                    <th>@lang('panel.purchase_saving')</th>
                                    <th>@lang('panel.delivery_saving')</th>
                                    <th>@lang('panel.total_saved')</th>
                                    <th>@lang('panel.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rules as $rule)
                                    <tr>
                                        <td>{{$rule->category->name}}</td>
                                        <td>{{$rule->quantityPerPackage}}</td>
                                        <td>${{$rule->unitPrice}}</td>
                                        <td>{{$rule->discount}}%</td>
                                        <td>${{$rule->priceDiscount}}</td>
                                        <td>${{$rule->packageDiscount}}</td>
                                        <td>${{$rule->packagePrice}}</td>
                                        <td>${{$rule->savedPurchase}}</td>
                                        <td>${{$rule->savedShipping}}</td>
                                        <td>${{$rule->savedTotal}}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" style="color:#fff;" href="{{ url('admin/editRule/'.$rule->id)}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
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
            $('#table-rules').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
                 },
                 "responsive": true,
                 "bSort": false,
                 "dom": 'Bfrtip',
                 "buttons": ['csv', 'excel', 'pdf', 'print']
            });
        @else
           $('#table-rules').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json"
                 },
                 "responsive": true,
                 "bSort": false,
                 "dom": 'Bfrtip',
                 "buttons": ['csv', 'excel', 'pdf', 'print']
           });
        @endif
    </script>
@endpush

  @endsection
