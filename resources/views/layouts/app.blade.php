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

        <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/dropzone/dropzone.css">
        <link rel="stylesheet" href="plugins/datedropper/datedropper.min.css">
        <link rel="stylesheet" href="plugins/jquery-ui-1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" href="plugins/summernote/dist/summernote-bs4.css">
        <link rel="stylesheet" href="dist/css/theme.min.css">
        <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- datatables-->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('layouts/froalaCss')
    </head>

    <body id="app">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrapper">
            <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>

                            <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                        </div>
                        <div class="top-menu d-flex align-items-center">

                            <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik ik-settings"></i></button>

                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="{{(Auth::user()->imagen)? env('URL_BASE_UPLOADS').Auth::user()->imagen : env('URL_BASE_UPLOADS').'user.png'}}" alt=""></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('perfil',['id'=>Auth::user()->id]) }}"><i class="ik ik-user dropdown-icon"></i> Perfil</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="ik ik-power dropdown-icon"></i> Salir</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>

            <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="{{url('home')}}">
                            <div class="logo-img">
                                <img src="img/logoMovil.png" class="header-brand-img" alt="lavalite" width="100%">
                            </div>
                            <span class="text">DevLAB</span>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>

                    <div class="sidebar-content">
                        <div class="nav-container">
                            @include('layouts.nav')
                        </div>
                    </div>
                </div>

                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <div class="d-inline">
                                            <span>Panel de Control para:</span>
                                            <img src="{{env('URL_BASE').'img/logoB.png'}}" style="width: 39px;margin: 1px -60px 0 0;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('home')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{!! $seccion !!}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                         @yield('content')
                    </div>
                </div>

                <div class="right-sidebar"><span class="messages"></span></div>
                <div class="right-sidebar-expand"></div>
                <footer class="footer">
                    <div class="w-100 clearfix">
                        <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020 Todos los derechos reservados.</span>
                        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Desarrollado por <a href="#" class="text-dark" target="_blank"></a>DevLAB</span>
                    </div>
                </footer>

            </div>
        </div>

        <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body d-flex align-items-center">
                        <div class="container">
                            <div class="apps-wrap">

                                <div class="app-item">
                                    <a href="{{route('configuracion')}}" title="Permite cargar los datos del laboratorio"><i class="ik ik-settings"></i><span>Registro de laboratorio</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="{{route('firmas')}}" title="Permite cargar las imagenes de las firmas del bioquimico/a"><i class="ik ik-edit-1"></i><span>Carga de Firmas</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="{{route('indexnbu')}}" title="Permite actualizar los valores del NBU"><i class="ik ik-underline"></i><span>NBU</span></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
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
        <script>
            window.fwSettings={
            'widget_id':67000000398
            };
            !function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}() 
        </script>
        <script type='text/javascript' src='https://widget.freshworks.com/widgets/67000000398.js' async defer></script>
    </body>
</html>
