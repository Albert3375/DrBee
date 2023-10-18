<div class="container-fluid">
    <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        @include('flash::message')
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <strong>@lang('panel.category')</strong> </div>
          <div class="card-body">

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input" required>@lang('panel.name')</label>
              <div class="col-md-9">
                <input class="form-control" required id="text-input" type="text" value="{{ $method == 'EDIT' ? $category->name : '' }}" name="name">
              </div>
            </div>

            <div class="form-group row">
    <label class="col-md-3 col-form-label" for="text-input" required>@lang('panel.percentage')</label>
    <div class="col-md-9">
    <input class="form-control" min="0" max="100" required id="text-input" type="number" value="{{ $method == 'EDIT' ? $category->percentage : '0' }}" name="percentage">

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
                <label class="col-md-3 col-form-label" for="category_id">Categoria</label>
                <div class="col-md-9">
                  <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $category->created_at : $date_formated }}" name="created_at" readonly>
              </div>
            </div>

          </div>
        </div>
        </div>

        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
