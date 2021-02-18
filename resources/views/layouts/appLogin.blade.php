<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <base href="{{env('APP_URL')}}">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="./favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="./plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="./plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="./plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="./plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="./dist/css/theme.min.css">
        <script src="./src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="./src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="./plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="./plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="./plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="./plugins/screenfull/dist/screenfull.js"></script>
        <script src="./dist/js/theme.js"></script>

    </body>
</html>
