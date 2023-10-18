@extends('admin.styles')

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('panel.home')</li>
        <li class="breadcrumb-item active">@lang('panel.orders')</li>
    </ol>

    @include('flash::message')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    
                        <div class="col-md-12">
                    <div class="shadow card bg-light">
                        <div class="card-body">
                            <h4 class="mb-2">
                                <i class="fas fa-map-marker"></i>
                                @lang('panel.address_info')
                            </h4>
                            <hr>
                           
                            <div class="row" align="center">
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000;border-top: 1px solid #000;">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.title'):</h5>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-right: 1px solid #000; border-top: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">
                                        {{ $adress->title }} 

                            
                                    </p>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.street')
                                    </h5>
                                </div>
                                <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">
                                            {{ $adress->street }} {{ $adress->numberExt }} 
                                    </p>
                                </div>
                                <div class="col-md-6"
                                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.colony')
                                    </h5>
                                </div>
                               <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                            {{ $adress->col }}
                                    </p>
                                </div>

                                <div class="col-md-6"
                                style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                                <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.municipality')
                                </h5>
                            </div>
                           <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                                <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                        {{ $adress->municipality }}
                                </p>
                            </div>

                            <div class="col-md-6"
                            style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                            <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.state')
                            </h5>
                        </div>
                       <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                            <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                    {{ $adress->state }}
                            </p>
                        </div>

                        <div class="col-md-6"
                        style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                        <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.country')
                        </h5>
                    </div>
                   <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                        <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                                {{ $adress->country }}
                        </p>
                    </div>

                    <div class="col-md-6"
                    style="border-bottom: 1px solid #000; border-left:1px solid #000; border-right: 1px solid #000; ">
                    <h5 style="padding-top: 15px; font-size: 18px; font-weight: 300;">@lang('panel.postal')
                    </h5>
                </div>
               <div class="col-md-6" style="border-bottom: 1px solid #000; border-right: 1px solid #000; ">
                    <p style="font-weight: 500; font-size: 18px; padding-top: 15px">

                            {{ $adress->postalCode }}
                    </p>
                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>

    @endpush

@endsection
