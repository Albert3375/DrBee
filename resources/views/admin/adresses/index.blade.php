@extends('admin.styles')

<style>
  <style>
    .btn:focus,.btn:hover,.btn.active {
        box-shadow: none;
        outline: medium none;
    }
    button:focus {
        outline:none;
    }
    .btn {
        border-width: 1px;
        cursor: pointer;
        line-height: normal;
        padding: 12px 35px;
        text-transform: capitalize;
        transition: all 0.3s ease-in-out;
    }
    .btn.active:focus, .btn:active:focus {
        box-shadow: none !important;
    }
    .btn-fill-out {
        background-color: transparent;
        border: 1px solid #ff9300;
        color: #fff;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .btn-fill-out::before,
    .btn-fill-out::after {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        background-color: #ff9300;
        z-index: -1;
        transition: all 0.3s ease-in-out;
        width: 51%;
    }
    .btn-fill-out::after {
        right: 0;
        left: auto;
    }
    .btn-fill-out:hover:before,
    .btn-fill-out:hover:after {
        width: 0;
    }
    .btn-fill-out:hover {
        color: #ff9300 !important;
    }
    .btn-line-fill:before, .btn-line-fill:after {
    position: absolute;
    top: 50%;
    content: '';
    width: 20px;
    height: 20px;
    background-color: #333;
    border-radius: 50%;
    z-index: -1;
}
.btn-line-fill:before {
    left: -20px;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
.btn-line-fill:after {
    right: -20px;
    -webkit-transform: translate(50%, -50%);
    transform: translate(50%, -50%);
}
.btn-line-fill:hover:before {
    -webkit-animation: criss-cross-left 0.7s both;
    animation: criss-cross-left 0.7s both;
    -webkit-animation-direction: alternate;
    animation-direction: alternate;
}
.btn-line-fill:hover:after {
    -webkit-animation: criss-cross-right 0.7s both;
    animation: criss-cross-right 0.7s both;
    -webkit-animation-direction: alternate;
    animation-direction: alternate;
}
</style>

</style>
  
@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.addresses')</li>
  </ol>

  @include('flash::message')

   {!! Form::open([
        'action' => ['AdressesController@store'],
      ])
    !!}

    @include('admin.adresses.form')

  {!! Form::close() !!}

  <div class="row">
   <div class="col-md-12" align="center">
       <div class="col-lg-4 col-md-4 mb-md-0">
        <a href="{{URL('/checkout')}}" class="btn btn-lg btn-fill-out">
            <i class="fas fa-shopping-basket"></i>
            @lang('cart.continue')
        </a>
     </div>
    </div>
  </div>

  <br>

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"></i>@lang('panel.delivery_addresses')</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">@lang('panel.all_addresses')</h5>
              </div>
              {{-- <div class="col-md-6" align="right">
                 <a href="{{ route('admin.adresses.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> @lang('panel.new_address')
                  </a>
              </div> --}}
              <div class="col-md-12">
                    <br>
                    <table id="table-adresses" class="display">
                        <thead>
                            <tr align="center">
                                <th>@lang('panel.title')</th>
                                <th>@lang('panel.address')</th>
                                <th>@lang('panel.postal')</th>
                                <th>@lang('panel.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($adresses as $adress)
                            <tr align="center">
                                @php $stringAdress = $adress->street . " " . $adress->numberExt; 
                                  if(isset($adress->numInt)){
                                    $stringAdress = $stringAdress . " Int." . $adress->numInt; 
                                  }
                                  $stringAdress = $stringAdress  . " " . $adress->col . " " . $adress->municipality 
                                  . ", " . $adress->state . ", " . $adress->country;      
                                @endphp
                                <td>{{$adress->title}}</td>
                                <td>{{$stringAdress}}</td>
                                <td>{{$adress->postalCode}}</td>
                                <td>
                                  <ul class="list-inline" style="margin: 0px;">
                                    <li class="list-inline-item">
                                      <a class="btn btn-success btn-sm" href="{{ route('admin.adresses.edit', $adress->id) }}" title="{{ trans('panel.edit') }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    </li>
                                    <li class="list-inline-item">
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route('admin.adresses.destroy', $adress->id),
                                          'method' => 'DELETE',
                                          ])
                                      !!}
                                          <button class="btn btn-danger btn-sm" title="{{ trans('panel.delete') }}"><i class="fas fa-trash-alt"></i></button>
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
        $('#table-adresses').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             },
             "responsive": true,
             "bSort": false
        });
    @else
       $('#table-adresses').DataTable({
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
