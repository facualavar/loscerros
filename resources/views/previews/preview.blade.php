<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <base href="{{env('APP_URL')}}">
    <link rel="stylesheet" href="dist/css/bootstrap-pdf.css">
    <title>Informe - {{env('NAME_COMPANY')}}</title>
</head>

    @include('previews.estilos')
    @include('previews.header')

<body>
    @include('previews.contenido')
</body>
</html>
