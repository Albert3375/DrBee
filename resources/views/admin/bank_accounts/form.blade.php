<div class="container-fluid">
  <div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      @include('flash::message')
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <strong>@lang('panel.bank')</strong> </div>
        <div class="card-body">

          {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">@lang('panel.name')</label>
            <div class="col-md-9">
              <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $bank_account->name : '' }}" name="name">
            </div>
          </div>

          @php
            $now = Carbon\Carbon::now();
            $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
          @endphp

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">@lang('panel.register_date')</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $bank_account->created_at : $date_formated }}" name="created_at" readonly>
            </div>
          </div>

          {{-- <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Fecha de Actualización</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $bank_account->updated_at : $date_formated }}" name="updated_at" readonly>
            </div>
          </div> --}}
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
