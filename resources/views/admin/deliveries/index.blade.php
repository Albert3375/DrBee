@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Pedidos</li>
  </ol>

  @include('flash::message')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="p-1">
                        <h4 class="card-title m-0 p-1">
                        <i class="nav-icon fas fa-th"></i> Pedidos
                        </h4>
                    </div>
                    <div class="p-1">
                        <a href="{{ route('admin.deliveries.create') }}" class="btn btn-success" style="color:#fff;">
                            <i class="fa fa-plus"></i> Nuevo Pedido
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <div class="p-0">
                                    <select class="form-control" id="estatus" name="estatus" style="width: 100%; max-width: 380px;">
                                        <option value="">Todos los pedidos</option>
                                    </select>
                                </div>
                                <div class="p-0">
                                    <div class="col-md-2 dropdown">
                                        <button class="btn btn-primary dropbtn">
                                            Exportar Registros<i class="fas fa-download pl-2"></i>
                                        </button>
                                        <div class="dropdown-content drop-tools">
                                            <a href="#" data-action="0"><i class="fas fa-copy"></i> Copiar</a>
                                            <a href="#" data-action="1"><i class="fas fa-file-excel"></i> Excel</a>
                                            <a href="#" data-action="2"><i class="fas fa-print"></i> Imprimir</a>
                                            <a href="#" data-action="3"><i class="fas fa-file-csv"></i> CSV</a>
                                            <a href="#" data-action="4"><i class="fas fa-redo-alt"></i> Reload</a>
                                          </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                        </div>
                        <div class="col-md-12">
                            <table id="table-deliveries" class="display"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('script')
<script>
    var estatus = {
        'completed': 'Pagado (completado)',
        'on-hold': 'Por pagar (en espera)',
        'processing': 'Pagado (pedido en proceso)',
        'pending': 'Por pagar (pendiente)',
        'failed': 'Pago no efectuado (fallido)',
        'cancelled': 'Cancelado',
        'refunded': 'Reembolsado',
    }

    $(function () {
        for(x in estatus) {
            $('#estatus').append('<option value="'+x+'">'+estatus[x]+'</option>');
        }

        $('#estatus').on('change', () => {
            $('#table-deliveries').DataTable().ajax.reload()
        })

        $('#table-deliveries').DataTable({
            processing: true,
            serverSide: true,
            async: true,
            ajax: {
                url: '{{ route('admin.deliveries.json') }}',
                type: 'POST',
                data: function (d) {
                    d._token = '{{ csrf_token() }}',
                    d.estatus = $('#estatus').val()
                }
            },
            sAjaxDataProp: "data",
            columns: [
                {
                    title: 'ID Pedido',
                    name: 'pedidos.idPedido',
                    data: 'idPedido'
                },
                {
                    title: 'Nombre del Cliente',
                    name: 'pedidos.nombreContacto',
                    data: 'nombreContacto'
                },
                {
                    title: 'Número telefónico',
                    name: 'pedidos.telefono',
                    data: 'telefono'
                },
                {
                    title: 'Estatus',
                    name: 'pedidos.estatus',
                    data: (data) => {
                        if (typeof estatus[data.estatus] !== 'undefined') {
                            return estatus[data.estatus]
                        } else {
                            return 'Estatus no reconocido'
                        }
                    }
                },
                {
                    title: 'Método de pago',
                    name: 'pedidos.tipoPago',
                    data: 'tipoPago'
                },
                {
                    title: 'Registro',
                    name: 'pedidos.fechaPedido',
                    data: (data) => {
                        let fecha = data.fechaPedido
                        return moment(fecha).format('LL');
                    }
                }
            ],
        });
    });
</script>
@endpush

@endsection
