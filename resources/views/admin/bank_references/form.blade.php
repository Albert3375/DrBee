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
            <strong>>@lang('panel.references')</strong> </div>
          <div class="card-body">

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">ID</label>
                <div class="col-md-9">
                    {!! Form::select('bank_id', $banks, 0, ['class'=>'form-control', 'required']) !!}
                  {{-- <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $reference->bank_id : '' }}" name="bank_id"> --}}
                </div>
              </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.holder')</label>
              <div class="col-md-9">
                <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $reference->holder : '' }}" name="holder">
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">@lang('panel.type')</label>
                <div class="col-md-9">
                  <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $reference->type : '' }}" name="type">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">@lang('panel.reference')</label>
                <div class="col-md-9">
                  <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $reference->references : '' }}" name="references">
                </div>
              </div>



            @php
              $now = Carbon\Carbon::now();
              $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
            @endphp

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.register_date')</label>
              <div class="col-md-9">
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $reference->created_at : $date_formated }}" name="created_at" readonly>
              </div>
            </div>

          </div>
        </div>
        </div>

        <div class="col-md-3"></div>
      </div>
    </div>
  </div>
