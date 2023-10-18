<!DOCTYPE html>
<html lang="es_MX">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zoofish - Panel de Administración - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon.png') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="IA Society, Synapdevs">
    <meta name="keyword" content="IA Society, Synapdevs">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    <!-- Icons-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link href="{{ asset('coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('coreui/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('coreui/font-awesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('coreui/font-awesome/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('coreui/font-awesome/css/solid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('coreui/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('css/style 2.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/pace-progress/css/pace.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"/>
      <link rel="stylesheet" href="{{asset('assets/vendor/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

    <script src="https://kit.fontawesome.com/2b834368dd.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.min.css">
    <link rel="stylesheet"
        type="text/css"href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic' type='text/css'"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">

    <script type="text/javascript">
        document.oncontextmenu = function() {
            return false;
        }
    </script>

    <style type="text/css">
        table.dataTable thead th,
        table.dataTable thead td {
            padding: 0.5px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.3)
        }
    </style>

    <style>
        :root {
            --main-color: #00abff;
            --hover-color: #006cff;
        }

        table th, td {
            text-align: center;
        }

        .dropbtn {
            background-color: var(--main-color);
            color: white;
            border: none;
            width: 100%;
            min-width: 180px;
            font-size: 14px;
            border-radius: 3px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: true;
            position: absolute;
            background-color: whitesmoke;
            min-width: 160px;
            -webkit-box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            -moz-box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: rgb(224, 224, 224);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: var(--hover-color);
            color: whitesmoke;
        }

        .dropdown .dropbtn:focus {
            background-color: var(--hover-color);
            color: whitesmoke;
        }
    </style>
  </head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('admin.partials.header')
    <div class="app-body">
        @include('admin.partials.menu')
        <main class="main">
        @yield('content')
        </main>
        @include('admin.partials.aside')
    </div>

    @include('admin.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('coreui/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('coreui/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('coreui/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('coreui/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('coreui/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('coreui/coreui/dist/js/coreui.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('coreui/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js') }}"></script>
    <script src="{{asset('src/js/main.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  
    <script src="{{asset('assets/vendor/DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://kit.fontawesome.com/5a13b5fda8.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es-mx.min.js" ></script>
    <!-- <script>
        // var dt_lang = "{{ App::isLocale('es')? '//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json' : '//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json' }}";
        var main_height = $( 'main' ).height();

        function setDtConfig() {
            if (typeof ($.fn.dataTable) === 'undefined') { return }

            $.extend( true, $.fn.dataTable.defaults, {
                "language": {
                    "url": "{{ App::isLocale('es')? '//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json' : '//cdn.datatables.net/plug-ins/1.11.3/i18n/en-gb.json' }}",
                },
                lengthMenu: [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Todos"]],
                pageLength: 50,
                responsive: true,
                buttons: [
                    { extend: 'copy' },
                    { extend: 'excelHtml5', title: 'Reporte ' + moment().format('ll') },
                    { extend: 'print', title: 'Reporte ' + moment().format('ll') },
                    { extend: 'csvHtml5', title: 'Reporte ' + moment().format('ll') },
                    {
                        text: 'reload',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload()
                        }
                    },
                ],
            })

            $('.drop-tools').on('click', 'a', (e) => {
                e.preventDefault()
                let action = $(e.currentTarget).attr('data-action');
                $('table-orders').DataTable().button(action).trigger()
            })
        }

        setDtConfig()
    </script> -->

    <script type="text/javascript">
        document.oncontextmenu = function() {
            return false;
        }
    </script>
    @stack('script')
</body>
</html>