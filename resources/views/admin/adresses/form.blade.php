<div class="container">
  <div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      @include('flash::message')
    </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong>@lang('panel.delivery_address')</strong> 
          </div>

          <div class="card-body">

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">Nombre</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->title : 'Mi casa' }}" name="title">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.street')</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->street : '' }}" name="street">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.ext')</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->numberExt : '' }}" name="numberExt">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.int')</label>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{ $method == 'EDIT' ? $adress->numInt : '' }}" name="numInt">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.colony')</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->col : '' }}" name="col">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.municipality')</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->municipality : '' }}" name="municipality">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.state')</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->state : '' }}" name="state">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.country')</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->country : '' }}" name="country">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.postal')</label>
              <div class="col-md-9">
                <input class="form-control" required type="text" value="{{ $method == 'EDIT' ? $adress->postalCode : '' }}" name="postalCode">
              </div>
            </div>

            {{--@php
              $now = Carbon\Carbon::now();
              $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
            @endphp

             <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">Fecha de Registro</label>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{ $method == 'EDIT' ? $adress->created_at : $date_formated }}" name="created_at" readonly>
              </div>
            </div> --}}

            {{-- <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">Fecha de Actualización</label>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{ $method == 'EDIT' ? $adress->updated_at : $date_formated }}" name="updated_at" readonly>
              </div>
            </div> --}}
          </div>

          <div class="card-footer" align="center">
            <button class="btn btn-sm btn-success" type="submit">
              <i class="fa fa-check"></i> @lang('panel.save')</button>
            <button class="btn btn-sm btn-danger" type="reset">
              <i class="fa fa-times"></i> @lang('panel.clean')</button>
            <a href="{{ URL('admin/adresses') }}" class="btn btn-sm btn-danger">
              <i class="fa fa-ban"></i> @lang('panel.cancel')</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
