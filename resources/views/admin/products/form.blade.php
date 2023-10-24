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
            <strong>@lang('products.product')</strong> </div>
          <div class="card-body">

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.name')</label>
              <div class="col-md-9">
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $product->name : '' }}" name="name" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.description')</label>
              <div class="col-md-9">
                <textarea class="form-control"  style="resize: none" type="text" value="{{ $method == 'EDIT' ? $product->description : '' }}" name="description"  rows="8" cols="80" required>{{ $method == 'EDIT' ? $product->description : '' }}</textarea>
              </div>
            </div>

          {{--   <div class="form-group row">
              <label class="col-md-3 col-form-label" for="img">Imagen del Producto M&aacute;x. 2MB</label>
              <div class="col-md-9">
                  <input class="form-control" type="file" name="img"/>
              </div>
            </div> --}}

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="img">@lang('panel.product_image') @lang('panel.max') 2MB</label>
                <div class="col-md-9">
                    @if(isset($product->image))
                        <img src="{{ URL($product->image) }}" style="width: auto !important; height: auto !important; max-width: 100%;">
                        <input value="{{ $product->image }}" class="form-control" type="file" name="image"/>
                    @else
                      <input class="form-control" type="file" name="image"/>
                    @endif
                </div>
              </div>

              <div class="form-group row">

                <label class="col-md-3 col-form-label" for="text-input">@lang('panel.category_id')</label>
                <div class="col-md-9">
                  
                    {!! Form::select('category_id', $category, 0, ['class'=>'form-control']) !!}
                
                  {{-- <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $reference->bank_id : '' }}" name="bank_id"> --}}

                </div>
              </div>

           

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">@lang('panel.price')</label>
                <div class="col-md-9">

                  <input class="form-control" min = 0 id="text-input" type="number" step="any" value="{{ $method == 'EDIT' ? $product->price : '' }}" name="price" required>

                </div>
              </div>
<!-- 
             <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">@lang('panel.discount')</label>
                <div class="col-md-9">
                 
                <input class="form-control" min=0 max=100 id="text-input" type="number" value="{{ $method == 'EDIT' ? $product->discount : '' }}" name="discount"  required>
                </div>
                
              </div>   -->

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">@lang('panel.products_stock')</label>
                <div class="col-md-9">
                  <input class="form-control" min=0 id="text-input" type="number" value="{{ $method == 'EDIT' ? $product->stock : '' }}" name="stock" required>
                </div>
              </div>

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
             
--}}


            @php
              $now = Carbon\Carbon::now();
              $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
            @endphp

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.register_date')</label>
              <div class="col-md-9">
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $product->created_at : $date_formated }}" name="created_at" readonly>
              </div>
            </div>

          </div>
        </div>
        </div>

        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
