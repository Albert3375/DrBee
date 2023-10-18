@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active"> @lang('panel.my_cards')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon fa fa-credit-card"></i> @lang('panel.my_cards') </h4>
          </div>
          <div class="card-body">

            {{-- <p class="lead">No tienes formas de pago registradas.</p> --}}

            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0"> @lang('panel.saved_cards')</h5>
              </div>
              <div class="col-md-6" align="right">
                  <a href="/admin/payments/create">
                    <button type="button" style="color:#fff;" class="btn btn-info"><i class="fa fa-plus mr-1"></i>@lang('panel.new_card')</button>
                  </a>
              </div>
              <div class="col-md-12">
                <br>
                <table id="table-cards" class="display">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>@lang('panel.card_type')</th>
                            <th>@lang('panel.last_4')</th>
                            <th>@lang('panel.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($cards as $card)
                        <tr align="center">
                            <td>{{ $card->id }}</td>
                            @if($card->brand == 'visa')
                              <td><i class="fa fa-cc-visa"></i> Visa</td>
                            @elseif($card->brand == 'mastercard')
                              <td><i class="fa fa-cc-mastercard"></i> Mastercard</td>
                            @endif
                            <td>{{ $card->last4 }} </td>
                            <td>
                              <ul class="list-inline" style="margin: 0px;">
                                <li class="list-inline-item">
                                  {!! Form::open([
                                      'class' => 'delete',
                                      'url'  => route('admin.payments.destroy'),
                                      'method' => 'DELETE',
                                      ])
                                  !!}
                                      <input type="hidden" name="card_id" value="{{ $card->id }}">
                                      <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">
                                      <input type="hidden" name="source_index" value="{{ $card->source_index }}">
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

@push('script')
<script>
   @if(App::isLocale('es'))
        $('#table-cards').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-cards').DataTable({
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

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
