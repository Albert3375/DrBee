@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Conciliaciones</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0"><i class="nav-icon icon-people"></i> Conciliaciones </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title mb-0">Todas las Conciliaciones</h5>
              </div>
              <div class="col-md-6" align="right">
                 <a href="{{ route('admin.conciliations.create') }}" class="btn btn-success" style="color:#fff;">
                    <i class="fa fa-plus"></i> Nueva Conciliación
                  </a>
              </div>
              <div class="col-md-12">
                <table id="table-conciliations" class="display"></table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@push('script')
<script>
    var estatus = {
        'completed': 'Completada',
        'on-hold': 'En espera',
        'processing': 'Conciliación en proceso',
        'pending': 'Pendiente',
        'failed': 'Fallida',
        'cancelled': 'Cancelada',
    }

    $(function () {
        for(x in estatus) {
            $('#estatus').append('<option value="'+x+'">'+estatus[x]+'</option>');
        }

        $('#estatus').on('change', () => {
            $('#table-conciliations').DataTable().ajax.reload()
        })

        $('#table-conciliations').DataTable({
            processing: true,
            serverSide: true,
            async: true,
            ajax: {
                url: '{{ route('admin.conciliations.json') }}',
                type: 'POST',
                data: function (d) {
                    d._token = '{{ csrf_token() }}',
                    d.estatus = $('#estatus').val()
                }
            },
            sAjaxDataProp: "data",
            "dom": 'Brtip',
            buttons: [
                {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    }
                },
                        //'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
            columns: [
                {
                    title: 'ID Conciliación',
                    name: 'conciliations.id',
                    data: 'id'
                },
                {
                    title: 'ID Orden',
                    name: 'conciliations.order_id',
                    data: 'order_id'
                },
                {
                    title: 'Nombre del Cliente',
                    name: 'conciliations.client',
                    data: 'client'
                },
                {
                    title: 'Total',
                    name: 'conciliations.total',
                    data: 'total'
                },
                {
                    title: 'Estatus',
                    name: 'conciliations.status',
                    data: (data) => {
                        if (typeof estatus[data.status] !== 'undefined') {
                            return estatus[data.status]
                        } else {
                            return 'Estatus no reconocido'
                        }
                    }
                },
                {
                    title: 'Registro',
                    name: 'conciliations.created_at',
                    data: (data) => {
                        let fecha = data.created_at
                        return moment(fecha).format('LL');
                    } 
                },
                {
                    title: 'Comprobante de pago',
                    name: 'conciliations.payment_evidence',
                    data: 'id',
                    render: function ( data, type, full, meta ) {
                        return '<a class="btn btn-primary" href="conciliations/download/'+data+'" title="{{ trans("Descargar") }}"><i class="fa fa-download"></i></a>'

                    }
                },
                {
                    title: 'Acciones',
                    orderable:false,
                    data: 'id',
                    render: function ( data, type, full, meta ) {
                        return ('<a  class="btn btn-success btn-sm" href="conciliations/'+data+'/edit" title="{{ trans("Editar") }}"><i class="fa fa-pencil"></i></a>' 
                        +'<button onclick="deleteConciliation('+data+')" class="btn btn-danger btn-sm" title="{{ trans("Eliminar") }}"><i class="fas fa-trash-alt"></i></button>')
                    }
                }
            ],
        });
    });
    function deleteConciliation(id){
            if(confirm("Desea eliminar esta conciliación?")){
                $.ajax({
                url:     '/admin/conciliations/' + id,
                type:    'DELETE',
                data:    { 
                    src: 'show' , 
                    _token: '{{ csrf_token() }}', 
                    },
                success: function(response) {
                    window.location.href = "conciliations";
                }
            });
        }
      }
</script>
@endpush

@endsection
