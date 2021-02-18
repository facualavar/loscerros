<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <base href="{{env('APP_URL')}}">

         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="./plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="./plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="./plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="./plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="./plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="./plugins/dropzone/dropzone.css">
        <link rel="stylesheet" href="./plugins/datedropper/datedropper.min.css">
        <link rel="stylesheet" href="./plugins/jquery-ui-1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" href="./plugins/summernote/dist/summernote-bs4.css">
        <link rel="stylesheet" href="./dist/css/theme.min.css">
        <script src="./src/js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- datatables-->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('layouts/froalaCss')
    </head>

    <body id="app">
        <div class="wrapper">
            <div class="page-wrap">
                <header class="header-top p-1" header-theme="light">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between">
                            <div class="top-menu d-flex align-items-center">
                                <div class="">
                                    <a class="header-brand" href="{{ route('consultas') }}">
                                        <div class="logo-img">
                                            <img src="img/logoMovil.png" class="header-brand-img" alt="lavalite" width="40">
                                        </div>
                                        <span class="text">DevLAB</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="main-content px-1">
                    <div class="container">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <div class="d-inline">
                                            <img src="{{env('URL_BASE').'img/logoB.png'}}" style="width: 98px;margin: 1px -60px 0 0;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page">{!! $seccion !!}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                         @yield('content')
                    </div>
                </div>

                <footer class="footer px-1">
                    <div class="container">
                        <div class="w-100 clearfix">
                            <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020 Todos los derechos reservados.</span>
                            <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Desarrollado por <a href="#" class="text-dark" target="_blank"></a>DevLAB</span>
                        </div>
                    </div>                    
                </footer>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script src="plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="plugins/screenfull/dist/screenfull.js"></script>
        <script src="plugins/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/dropzone/dropzone.js"></script>
        <script src="js/datatables.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap.min.js"></script>
        <script src="plugins/moment/moment.js"></script>
        <script src="plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="plugins/datedropper/datedropper.min.js"></script>
        <script src="plugins/d3/dist/d3.min.js"></script>
        <script src="plugins/c3/c3.min.js"></script>
        <script src="plugins/jquery-tabledit/jquery.tabledit.js"></script>
        <script src="dist/js/theme.min.js"></script>
        <script src="js/form-picker.js"></script>
        <script src="plugins/sweetalert/dist/sweetalert.min.js"></script>
        <script src="plugins/summernote/dist/summernote-bs4.min.js"></script>
        <script src="plugins/summernote/dist/summernote-cleanner.js"></script>
        <!--  datatable-->
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
        @include('layouts/froalaScripts')
        @include('sweet::alert')
        @yield('scriptsextras')
    </body>
</html>
