@extends('web.partials.master')

@section('title', 'Confirmación de Compra')

@section('content')

<div class="container"style="margin-top: 150px;">
	<div class="row">
	  <div class="col-md-12" align="center">
	    <h2 class="section-title mb-5 mt-4" align="center">
	    	<i class="fa fa-shopping-cart"></i> Confirmación de Compra ✅
	    </h2>
	  </div>

	  <div class="col-md-12" align="center">
	    <div class="shadow card bg-light">
	     <div class="card-body">
	        <h3 class="mb-2">
	          <i class="fa fa-check"></i>
	          ¡Compra realizada con éxito!
	        </h3>
	        <hr>
	        <div class="mt-4 mt-lg-1 row">

	           <div class="col-lg-12 col-sm-12">
	                <h4>
	                <i class="fa fa-envelope"></i> Revisa tu bandeja de entrada, se te han enviado los detalles de la confirmación de la compra.
	              </h4>
	           </div>

	         </div>
	       </div>
	     </div>
	     <br>
	   </div>

	</div>
</div>


@push('script')
<script>
	
</script> 
@endpush

@endsection
