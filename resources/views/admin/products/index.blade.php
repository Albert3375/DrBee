@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.products')</li>
  </ol>

  @include('flash::message')

    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fa fa-dropbox"></i> @lang('panel.products')</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">@lang('panel.products')</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.products.create') }}" class="btn btn-info" style="color:#fff;">
                    <i class="fa fa-plus"></i> @lang('panel.new_product')
                  </a>
              </div>
              <div class="col-md-12">
                    <br>
                <div class="table-responsive p-t-10">
                    <table id="table-products" class="table" style="width:100%">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>@lang('panel.name')</th>
                                <th>@lang('panel.description')</th>
                                <th>@lang('panel.image')</th>
                                <th>@lang('panel.category')</th>
                             
                                <th>@lang('panel.price')</th>
                                <th>@lang('panel.discount')</th>
                                <th>@lang('panel.stock')</th>
                                <th>@lang('panel.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                            <tr align="center">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }} </td>
                                <td>{{ $product->description }}</td>
                                @if($product->image != null)
                                <td>
                                    <img src="{{ URL($product->image) }}" style="width: auto !important; height: auto !important; max-width: 80%;">
                                </td>
                                @else
                                <td>
                                  @lang('panel.no_image')
                                </td>
                                @endif
                                <td>{{ $product->category->name }}</td>
                            
                                <td>{{ $product->price }}</td>
                                <td>
    @if ($product->category->percentage == 0)
        0%
    @else
        {{ $product->category->percentage }}%
    @endif
</td>

                                <td>{{ $product->stock }}</td>
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    <li class="list-inline-item">
                                      <a class="btn btn-success btn-sm" href="{{ route('admin.products.edit', $product->id) }}" title="{{ trans('panel.edit') }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    </li>
                                    <li class="list-inline-item">
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route('admin.products.destroy', $product->id),
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
        </div>
{{-- @push('script')
<script>
    $(document).ready(function() {
        $('#table-products').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endpush --}}


@push('script')
<script>
   @if(App::isLocale('es'))
        $('#table-products').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
             },
             "responsive": true,
             "bSort": false,
             "dom": "Bfrtip",
             buttons: [
              'copy', 'csv', 'excel'
              ],
        });
    @else
       $('#table-products').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json"
             },
             "responsive": true,
             "bSort": false,
             "dom": "Bfrtip",
             buttons: [
              'copy', 'csv', 'excel'
              ],
       });
    @endif
</script>
@endpush

@endsection
