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
            <strong>Guia</strong> </div>
          <div class="card-body">

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">Direccion 1</label>
              <div class="col-md-9">
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_addrees1 : '' }}" name="destination_info_addrees1" required>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Direccion 2</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_address2 : '' }}" name="destination_info_address2" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Ciudad</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_city : '' }}" name="destination_info_city" required>
                </div>
              </div>

              {{-- <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Nombre de contacto</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_contactName : '' }}" name="destination_info_contactName" required>
                </div>
              </div> --}}

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Corporacion</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_corporateName : '' }}" name="destination_info_corporateName" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Colonia</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_neighborhood : '' }}" name="destination_info_neighborhood" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Numero de telefono</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_phoneNumber : '' }}" name="destination_info_phoneNumber" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Estado</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_state : '' }}" name="destination_info_state" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Validacion</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_valid : '' }}" name="destination_info_valid" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Codigo Postal</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_zipCode : '' }}" name="destination_info_zipCode" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Número Móvil</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_CellPhone : '' }}" name="destination_info_CellPhone" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">Nombre de Contacto</label>
                <div class="col-md-9">
                  <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $estafeta->destination_info_contactName : '' }}" name="destination_info_contactName" required>
                </div>
              </div>

            @php
              $now = Carbon\Carbon::now();
              $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
            @endphp

            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="text-input">Fecha de Registro</label>
              <div class="col-md-9">
                <input class="form-control" id="text-input" type="text" value="{{ $method == 'EDIT' ? $product->created_at : $date_formated }}" name="created_at" readonly>
              </div>
            </div>

          </div>
        </div>
        </div>

        <div class="col-md-3"></div>
      </div>
    </div>
  </div>
