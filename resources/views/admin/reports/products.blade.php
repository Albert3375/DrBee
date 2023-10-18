<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reporte de Productos</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel=" stylesheet">
    </head>

    <style>
    @page {
    margin-top: 1cm;
    margin-bottom: 1cm;
    margin-left: 1cm;
    margin-right: 1cm;
    }
    @media print {
    body {margin-top: 10mm; margin-bottom: 10mm;
    margin-left: 10mm; margin-right: 10mm}
    }
    div .attendance{
     border: 1px solid;
     font-family: 'Poppins';
    }
    p{
    line-height: 95%;
    }
    h2{
    line-height: 80%;
    }
    h3{
    line-height: 80%;
    }
    h4{
    line-height: 80%;
    }
    h5{
    line-height: 80%;
    }
    .text{
        font-family: 'Poppins';
    }
    th, td {
          padding: 5px;
          vertical-align: middle;
          font-size: 18px;
      }
    </style>

<body style="font-family: 'Poppins';">

	<div class="container">
		<div class="row">
			<div class="col-md-12" align="center" style="margin-top: 30px;">
				<img src="img/footer-logo.png" style="width: auto !important; height: auto !important; max-width: 75%;">

                @php
                    $now = \Carbon\Carbon::now();
                @endphp 
                <br>
                <br>
                <h5>Fecha de impresión: {{$now}}</h5>
			</div>

        </div>

        <div class="row">
            <div class="col-md-12" align="center" style="margin-top: 30px; margin-bottom: 30px;">
                <h3>Detalle del Reporte de Productos</h3>
            </div>
		</div>
	</div>

    <table class="table">
        <thead class="thead-dark">
            <tr align="center">
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody align="center">
            @foreach(json_decode($data) as $key => $index)
                <tr align="center" style="font-size: 12px">
                    <td>{{$key}}</td>
                    <td>{{$index}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12" align="center" style="margin-top: 30px;">
                <h3>Gráfico Estadístico</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" align="center" style="margin-top: 30px;">
                <img src="reports/chart.png" style="width: auto !important; height: auto !important; max-width: 100%;">
            </div>

        </div>
    </div> --}}

</body>

</html>
