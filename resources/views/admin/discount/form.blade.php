<div class="container-fluid">
    <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="card">
            <div class="card-header" align="center">
              <strong><i class="fa fa-percent" aria-hidden="true"></i> @lang('panel.discount')</strong>
            </div>
            <div class="card-body">
                <div class="form-group row">
                  <label class="col-md-6 col-form-label" for="text-input" align="center">
                    <h4 >@lang('panel.current_discount')</h4>
                  </label>
                  <div class="col-md-6" align="center">
                    <div class="input-group">
                    <input class="form-control" id="text-input" min=0 max=100 type="number" value="{{ $method == 'EDIT' ? $discount->value : '' }}" name="value" placeholder="Descuento">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="fa fa-percent" aria-hidden="true"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </div>
