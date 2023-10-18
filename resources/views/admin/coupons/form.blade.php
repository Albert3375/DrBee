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
            <strong>Cupón de descuento</strong> </div>
          <div class="card-body">

            <div class="form-group row">
				<label class="col-md-3 col-form-label" for="text-input" required>Nombre</label>
				<div class="col-md-9">
					<input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $coupon->name : '' }}" name="name">
				</div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Categoría</label>
                <div class="col-md-9">
                    {!! Form::select('category', $category, 0, ['class'=>'form-control']) !!}
                </div>
              </div>

            <div class="form-group row">
				<label class="col-md-3 col-form-label" for="text-input" required>Duración</label>
				<div class="col-md-9">
					<input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $coupon->duration : '' }}" name="duration">
				</div>
            </div>

             <div class="form-group row">
				<label class="col-md-3 col-form-label" for="text-input" required>Cantidad</label>
				<div class="col-md-9">
				  <input class="form-control" min=0 max=1000 required id="text-input" type="number" value="{{ $method == 'EDIT' ? $coupon->quantity : '' }}" name="quantity">
				</div>
			</div>

            <div class="form-group row">
				<label class="col-md-3 col-form-label" for="text-input" required>Validación</label>
				<div class="col-md-9">
				 <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $coupon->validation : '' }}" name="validation">
				</div>
			</div>

           

          {{--   <div class="form-group row">
              <label class="col-md-3 col-form-label" for="img">Imagen del Producto M&aacute;x. 2MB</label>
              <div class="col-md-9">
                  <input class="form-control" type="file" name="img"/>
              </div>
            </div> --}}

           

  {{--          <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">Detalles</label>
              <div class="col-md-9">
                <textarea class="form-control"  type="text" value="{{ $method == 'EDIT' ? $product->details : '' }}" name="details" rows="8" cols="80">{{ $method == 'EDIT' ? $product->details : '' }}</textarea>

              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Inventario</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $product->stock : '' }}" name="stock">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="coupon_id">Categoria</label>
                <div class="col-md-9">
                  <select class="form-control" id="coupon_id" name="coupon_id">
                    @foreach($categories as $coupon)
                      <option value="{{ $coupon->id }}">{{ $coupon->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div> --}}


            @php
              $now = Carbon\Carbon::now();
              $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
            @endphp

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.register_date')</label>
              <div class="col-md-9">
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $coupon->created_at : $date_formated }}" name="created_at" readonly>
              </div>
            </div>

          </div>
        </div>
        </div>

        <div class="col-md-3"></div>
      </div>
    </div>
  </div>
