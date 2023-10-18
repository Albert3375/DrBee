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
          <strong>Filtro</strong> </div>
        <div class="card-body">

          {{-- <input class="form-control" id="referal_code" type="hidden" value="{{ Auth::user()->member_code }}" name="referal_code" readonly> --}}

          {{-- @if ($method != 'EDIT')
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">@lang('panel.user_key')</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->member_code : $member_code }}" name="member_code" readonly>
            </div>
          </div>
          @endif --}}

          {{-- <div class="form-group row">
            <label class="col-md-3 col-form-label" for="role">Rol</label>
            <div class="col-md-9">
              <select class="form-control" id="role" name="role">
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->description }}</option>
                @endforeach
              </select>
            </div>
          </div> --}}



           <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Nombre</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $filter->name : '' }}" name="name">
            </div>
          </div>


         {{--  <div class="form-group row">
            <label class="col-md-3 col-form-label" for="rank">Rango</label>
            <div class="col-md-9">
              <select class="form-control" id="rank" name="rank">
                @foreach($ranks as $rank)
                  <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                @endforeach
              </select>
            </div>
          </div> --}}

          <div class="form-group row">

              <label class="col-md-3 col-form-label" for="text-input">@lang('panel.category_id')</label>
              <div class="col-md-9">
                  {!! Form::select('category_id', $category, 0, ['class'=>'form-control']) !!}
                {{-- <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $reference->bank_id : '' }}" name="bank_id"> --}}

              </div>
            </div>

          {{-- <div class="form-group row">
            <label class="col-md-3 col-form-label" for="level">Nivel</label>
            <div class="col-md-9">
              <select class="form-control" id="level" name="level">
                @foreach($levels as $level)
                  <option value="{{ $level->id }}">Nivel #{{ $level->id }} - {{ $level->percentage }}%</option>
                @endforeach
              </select>
            </div>
          </div> --}}

         {{--  <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Dirección</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->name : '' }}" name="address">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Colonia</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->colony : '' }}" name="colony">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Ciudad</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->city : '' }}" name="city">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Estado</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->state : '' }}" name="state">
            </div>
          </div> --}}

          @php
            $now = Carbon\Carbon::now();
            $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
          @endphp

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">@lang('panel.register_date')</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $filter->created_at : $date_formated }}" name="created_at" readonly>
            </div>
          </div>

          {{-- <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Fecha de Actualización</label>
            <div class="col-md-9">
              <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $user->updated_at : $date_formated }}" name="updated_at" readonly>
            </div>
          </div> --}}

           {{-- <div class="form-group row">
              <label class="col-md-3 col-form-label" for="category">Categoría</label>
              <div class="col-md-5">
                @php
                  if(isset($product->id_category)) {
                    $selectedValue = $product->id_category;
                  }else {
                    $selectedValue = 0;
                  }
                @endphp
                <select class="form-control" id="id_category" name="id_category">
                  @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedValue == $category->id ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="img">Imagen del producto M&aacute;x 2Mb</label>
              <div class="col-md-9">
                @if($method == 'EDIT' && $product->img != null)
                  <img src="{{ URL($product->img) }}" style="width: auto !important; height: auto !important; max-width: 20%; border-radius: 10px;">
                  <br />
                  <br />
                  <input type="file" name="img" value="{{ $product->img }}"/>
                @else
                  <input type="file" name="img" id="img" />
                @endif
              </div>
            </div>
             <div class="form-group row">
              <label class="col-md-3 col-form-label" for="pdf">Ficha t&eacute;cnica (PDF)<br>M&aacute;x 5Mb</label>
              <div class="col-md-9">
                @if($method == 'EDIT' && $product->pdf != null)
                  <embed name="pdf" src="{{url($product->pdf)}}" type="application/pdf">
                  <br />
                  <br />
                  <input type="file" name="pdf" value="{{ $product->pdf }}"/>
                @else
                  <input type="file" name="pdf" id="pdf" />
                @endif
              </div>
            </div> --}}
       {{--      <div class="form-group row">
              <label class="col-md-3 col-form-label" for="disabled-input">Disabled Input</label>
              <div class="col-md-9">
                <input class="form-control" id="disabled-input" type="text" name="disabled-input" placeholder="Disabled" disabled="">
              </div>
            </div> --}}
            {{-- <div class="form-group row">
              <label class="col-md-3 col-form-label" for="select1">Select</label>
              <div class="col-md-9">
                <select class="form-control" id="select1" name="select1">
                  <option value="0">Please select</option>
                  <option value="1">Option #1</option>
                  <option value="2">Option #2</option>
                  <option value="3">Option #3</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="select2">Select Large</label>
              <div class="col-md-9">
                <select class="form-control form-control-lg" id="select2" name="select2">
                  <option value="0">Please select</option>
                  <option value="1">Option #1</option>
                  <option value="2">Option #2</option>
                  <option value="3">Option #3</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="select3">Select Small</label>
              <div class="col-md-9">
                <select class="form-control form-control-sm" id="select3" name="select3">
                  <option value="0">Please select</option>
                  <option value="1">Option #1</option>
                  <option value="2">Option #2</option>
                  <option value="3">Option #3</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="disabledSelect">Disabled Select</label>
              <div class="col-md-9">
                <select class="form-control" id="disabledSelect" disabled="">
                  <option value="0">Please select</option>
                  <option value="1">Option #1</option>
                  <option value="2">Option #2</option>
                  <option value="3">Option #3</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="multiple-select">Multiple select</label>
              <div class="col-md-9">
                <select class="form-control" id="multiple-select" name="multiple-select" size="5" multiple="">
                  <option value="1">Option #1</option>
                  <option value="2">Option #2</option>
                  <option value="3">Option #3</option>
                  <option value="4">Option #4</option>
                  <option value="5">Option #5</option>
                  <option value="6">Option #6</option>
                  <option value="7">Option #7</option>
                  <option value="8">Option #8</option>
                  <option value="9">Option #9</option>
                  <option value="10">Option #10</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">Radios</label>
              <div class="col-md-9 col-form-label">
                <div class="form-check">
                  <input class="form-check-input" id="radio1" type="radio" value="radio1" name="radios">
                  <label class="form-check-label" for="radio1">Option 1</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" id="radio2" type="radio" value="radio2" name="radios">
                  <label class="form-check-label" for="radio2">Option 2</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" id="radio3" type="radio" value="radio2" name="radios">
                  <label class="form-check-label" for="radio3">Option 3</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">Inline Radios</label>
              <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" id="inline-radio1" type="radio" value="option1" name="inline-radios">
                  <label class="form-check-label" for="inline-radio1">One</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" id="inline-radio2" type="radio" value="option2" name="inline-radios">
                  <label class="form-check-label" for="inline-radio2">Two</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" id="inline-radio3" type="radio" value="option3" name="inline-radios">
                  <label class="form-check-label" for="inline-radio3">Three</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">Checkboxes</label>
              <div class="col-md-9 col-form-label">
                <div class="form-check checkbox">
                  <input class="form-check-input" id="check1" type="checkbox" value="">
                  <label class="form-check-label" for="check1">Option 1</label>
                </div>
                <div class="form-check checkbox">
                  <input class="form-check-input" id="check2" type="checkbox" value="">
                  <label class="form-check-label" for="check2">Option 2</label>
                </div>
                <div class="form-check checkbox">
                  <input class="form-check-input" id="check3" type="checkbox" value="">
                  <label class="form-check-label" for="check3">Option 3</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">Inline Checkboxes</label>
              <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" id="inline-checkbox1" type="checkbox" value="check1">
                  <label class="form-check-label" for="inline-checkbox1">One</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" id="inline-checkbox2" type="checkbox" value="check2">
                  <label class="form-check-label" for="inline-checkbox2">Two</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" id="inline-checkbox3" type="checkbox" value="check3">
                  <label class="form-check-label" for="inline-checkbox3">Three</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="file-input">File input</label>
              <div class="col-md-9">
                <input id="file-input" type="file" name="file-input">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="file-multiple-input">Multiple File input</label>
              <div class="col-md-9">
                <input id="file-multiple-input" type="file" name="file-multiple-input" multiple="">
              </div>
            </div> --}}
        </div>
      </div>
      </div>

      <div class="col-md-3"></div>
    </div>
  </div>
</div>
