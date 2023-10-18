@extends('admin.styles')

@section('content')

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">@lang('panel.home')</a></li>
    <li class="breadcrumb-item active">@lang('panel.reports')</li>
  </ol>

  @include('flash::message')

  <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">
                   <h4 class="card-title mb-0"><i class="nav-icon fa fa-file-pdf-o"></i> @lang('panel.reports') </h4>                
              </div>

          </div>
          <div class="card-body">
            <input id="data" style="display: none" type="text" >
            <form method="POST" action="/get_best_seller_products">
              @csrf
              <div class="row">
                  <div class="col-md-12">
                    <h5 class="card-title mb-0">@lang('panel.best_sellers')</h5>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <input class="form-control" type="date" name="startDate" >
                </div>
                <div class="col-md-4">
                  <input class="form-control" type="date" name="endDate" >
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="number" placeholder="Filtro top" name="number" value="10">
                </div>
              </div>
              <input style="display: none;" id="data" type="text" value="{{json_encode($data)}}">

              <div class="row" align="center">
              <div class="col-md-12" align="center">
              <a class="btn btn-success"
                      href="{{ url('admin/reports/download/'.json_encode($data))}}"
                      title="{{ trans('Descargar Información') }}" style="float: right; margin: 10px;">
                      <i class="fa fa-download"> Descargar</i>
                  </a>

                  <button type="submit" class="btn btn-info btn-md" style="float: right; margin: 10px;color:white;">
                    <i class="fas fa-redo-alt"></i> @lang('panel.generate')
                  </button>
             </div>
             </div>
            </form>
                    <div class="row"> 
                          <div class="col-md-12">
                            <br>
                            <table id="table-reports" class="display">
                                <thead>
                                    <tr align="center">
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @isset($data)
                                    @foreach($data as $key => $value)
                                    <tr align="center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$key}}</td>
                                        <td>{{$value}}</td>
                                    </tr>
                                    @endforeach
                                  @endisset
                                </tbody>
                            </table>
                          </div>
                    </div>
                    <button id="export-chart" class="btn btn-success">
                      <i class="fa fa-download"></i> Descargar gráfico</button>
                    <div class="row">                      
                      <div style=" margin: auto;
                      width: 50%;">
                          <canvas id="chart"></canvas>
                      </div>
                    </div>
              
                </div>
              </div>
            </div>
          </div>
        </div>
@push('script')

@php
  $path = public_path() . '/';
@endphp

<script>
    let data = <?php echo json_encode($data) ?>;
    if (typeof data === 'object') {
      const ctx = document.getElementById('chart').getContext('2d');
      // calculate colors 
      const background = [];
      for (i=0; i < Object.keys(data).length; i++) {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        background.push('rgba('+r+', '+g+', '+b+', 0.4 )');
      }
        const chart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: Object.keys(data),
            datasets: [{
              data: Object.values(data),
              hoverOffset: 4,
              backgroundColor: background
            }]
          }
        });
        $('#export-chart').click(() => {
            if (chart) {
              var a = document.createElement('a');
              a.href = chart.toBase64Image();
              a.download = "chart.png";
              a.click();
            }
        });

        // $('#export-chart').click();
    }
   
    
     $(document).ready(function() {
        $('#table-reports').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            bSort: false
        });
    });
</script>
@endpush

@endsection