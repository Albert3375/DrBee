@extends('admin.styles')

@section('content')

<style>
/* Estilo para centrar contenido y dar espacio a los botones */
.container {
    background-color: #f5f5f5; /* Color de fondo gris claro */
    border: 1px solid #3498db; /* Borde azul claro */
    border-radius: 10px; /* Borde redondeado */
    padding: 20px; /* Espaciado interno del contenedor */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.container h1 {
    color: #3498db; /* Color de texto azul */
}

/* Estilo para resaltar botones dentro del contenedor */
.container .btn {
    background-color: #3498db; /* Fondo azul para el botón */
    color: #ffffff; /* Texto blanco para el botón */
    border: none;
    border-radius: 3px;
    padding: 15px 30px; /* Aumento del espacio en los botones */
    margin: 10px 0; /* Espaciado entre los botones */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Transición de color de fondo al pasar el mouse */
}

.container .btn:hover {
    background-color: #2980b9; /* Cambio de color de fondo del botón al pasar el mouse */
}

</style>


<div class="container">
    <div class="py-4">
        <div class="text-center mb-4">
            <h1 class="display-4">Panel Productos</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Product
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

                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

                        <table id="example" class="display compact " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Imagen</th>
                                    <th>Categoria</th>
                                    <th>Precio</th>
                                    <th>Deescuento</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
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
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        @if ($product->category->percentage == 0)
                                        0%
                                        @else
                                        {{ $product->category->percentage }}%
                                        @endif
                                    </td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                    <li class="list-inline-item">
                                      <a class="btn btn-success btn-sm" href="{{ route('admin.products.edit', $product->id) }}" title="{{ trans('panel.edit') }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    </li>
                                        <li class="list-inline-item">
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route('admin.products.destroy', $product->id),
                                          'method' => 'DELETE',
                                          ])
                                      !!}
                                          <button class="btn btn-danger btn-sm" title="{{ trans('panel.delete') }}"><i class="fa fa-trash-o"></i></button>
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

@push('script')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>




<script>
    $(document).ready(function() {
        $('#example').DataTable({
            stateSave: true
        });
    });
</script>
@endpush

@endsection
