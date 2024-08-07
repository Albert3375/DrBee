@extends('adminlte::page')

@section('content')

<style>
    /* Estilos CSS aquí */
</style>

<div class="container">
    <div class="py-4">
        <div class="text-center mb-4">
            <h1 class="display-4">Panel Productos</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus"></i> Agregar Producto
                </a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Productos</h5>
                    </div>
                    <div class="card-body">
                        <table id="example" class="display compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Imagen</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Tipo</th> <!-- Nueva columna para el tipo de producto -->
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr id="product-{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        @if($product->image != null)
                                        <img src="{{ URL($product->image) }}" class="product-image" style="max-width: 150px; max-height: 150px;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>{{ $product->category->name }}</td> <!-- Muestra el nombre de la categoría -->
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ ucfirst($product->product_type) }}</td> <!-- Muestra el tipo de producto -->
                                    <td>
                                        <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">
                                            {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <li class="list-inline-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('admin.products.edit', $product->id) }}" title="Editar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            {!! Form::open(['class'=>'delete', 'url' => route('admin.products.destroy', $product->id), 'method' => 'DELETE']) !!}
                                            <button class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </li>
                                        <li class="list-inline-item">
                                            {!! Form::open(['class'=>'toggle-status', 'url' => $product->is_active ? route('admin.products.inactivate', $product->id) : route('admin.products.activate', $product->id), 'method' => 'POST']) !!}
                                            <button class="btn btn-{{ $product->is_active ? 'warning' : 'info' }} btn-sm toggle-status-btn" data-id="{{ $product->id }}" title="{{ $product->is_active ? 'Inactivar' : 'Activar' }}">
                                                <i class="fa {{ $product->is_active ? 'fa-ban' : 'fa-check' }}"></i> {{ $product->is_active ? 'Inactivar' : 'Activar' }}
                                            </button>
                                            {!! Form::close() !!}
                                        </li>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir jQuery primero -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Botones de exportación CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<!-- Botones de exportación JS -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            stateSave: true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: 'Exportar a CSV'
                },
                {
                    extend: 'excel',
                    text: 'Exportar a Excel'
                },
                {
                    extend: 'pdf',
                    text: 'Exportar a PDF'
                },
                {
                    extend: 'print',
                    text: 'Imprimir'
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json"
            }
        });

        // Manejar el cambio de estado
        $(document).on('click', '.toggle-status-btn', function (e) {
            e.preventDefault();
            var button = $(this);
            var form = button.closest('form');
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function (response) {
                    if (response.success) {
                        var row = button.closest('tr');
                        var statusCell = row.find('td:nth-child(8) span'); // Cambiado a 8 para incluir la columna de tipo
                        var isActive = statusCell.hasClass('badge-success');

                        if (isActive) {
                            statusCell.removeClass('badge-success').addClass('badge-danger').text('Inactivo');
                            button.removeClass('btn-warning').addClass('btn-info').html('<i class="fa fa-check"></i> Activar');
                            form.attr('action', form.attr('action').replace('inactivate', 'activate'));
                        } else {
                            statusCell.removeClass('badge-danger').addClass('badge-success').text('Activo');
                            button.removeClass('btn-info').addClass('btn-warning').html('<i class="fa fa-ban"></i> Inactivar');
                            form.attr('action', form.attr('action').replace('activate', 'inactivate'));
                        }
                    } else {
                        alert('Hubo un problema cambiando el estado del producto.');
                    }
                },
                error: function () {
                    alert('Hubo un problema cambiando el estado del producto.');
                }
            });
        });
    });
</script>

@endsection
