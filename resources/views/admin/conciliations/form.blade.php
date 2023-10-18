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
          <strong>Conciliación</strong> </div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="order_id">ID Orden</label>
            <div class="col-md-9">
              <input class="form-control" type="number" value="{{ $method == 'EDIT' ? $conciliation->order_id : '' }}" name="order_id">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="client">Cliente</label>
            <div class="col-md-9">
              <input class="form-control" type="text" value="{{ $method == 'EDIT' ? $conciliation->client : '' }}" name="client">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="total">Total</label>
            <div class="col-md-9">
              <input class="form-control"  type="number" step=".01" min=0 value="{{ $method == 'EDIT' ? $conciliation->total : '0' }}" name="total">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="payment_evidence">Comprobante de pago</label>
            <div class="col-md-9">
              @if(isset($conciliation->payment_evidence))
                <input class="form-control" type="file" value="{{ $conciliation->payment_evidence }}" name="payment_evidence">
              @else
                <input class="form-control" type="file" name="payment_evidence">
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">Estatus de la conciliación</label>
            <div class="col-md-9">
              <select id="select_status" class="form-control"  name="status" value="{{ $method == 'EDIT' ? $conciliation->status : ''}}">
                <option value="completed">Completada</option>
                <option value="on-hold">En espera</option>
                <option value="processing">Conciliación en proceso</option>
                <option value="pending">Pendiente</option>
                <option value="failed">Fallida</option>
                <option value="cancelled">Cancelada</option>
              </select>
            </div>
          </div>

          @php
            $now = Carbon\Carbon::now();
            $date_formated = Carbon\Carbon::parse($now)->format('d-m-Y');
          @endphp

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="created_at">Fecha de Registro</label>
            <div class="col-md-9">
              <input class="form-control" type="text" value="{{ $method == 'EDIT' ? $conciliation->created_at : $date_formated }}" name="created_at" readonly>
            </div>
          </div>

          {{-- <div class="form-group row">
            <label class="col-md-3 col-form-label" for="updated_at">Fecha de Actualización</label>
            <div class="col-md-9">
              <input class="form-control" type="text" value="{{ $method == 'EDIT' ? $conciliation->updated_at : $date_formated }}" name="updated_at" readonly>
            </div>
          </div> --}}
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@push('script')
<script>
    var status = $("#select_status").attr('value');
    $("#select_status").val(status);
</script>
@endpush