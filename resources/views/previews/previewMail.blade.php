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

    <div class="footer">
        <div class="row">
            <div class="footer">
            <div class="row">
                @switch($firmaImagen->id)
                    @case(1)
                        <img class="pull-right" src="{!!env('URL_BASE').'uploads/firmas/'.$firmaImagen->firmaImagen!!}" alt="" width="113px" style="margin-top:-100px">
                    @break
                    @case(2)
                        <img class="pull-right" src="{!!env('URL_BASE').'uploads/firmas/'.$firmaImagen->firmaImagen!!}" alt="" width="120px" style="margin-top:-90px">
                    @break
                    @case(4)
                        <img class="pull-right" src="{!!env('URL_BASE').'uploads/firmas/'.$firmaImagen->firmaImagen!!}" alt="" width="150px" style="margin-top:-90px">
                    @break
                    @default
                    @break
                @endswitch
            </div>
        </div>
        </div>
    </div>

    @include('previews.header')

<body>
    @include('previews.contenido')
</body>
</html>


{{-- <!DOCTYPE html>
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

    <div class="footer">
        <div class="row">
            @switch($firmaImagen->id)
                @case(1)
                    <img class="pull-right" src="{!!env('URL_BASE').'uploads/firmas/'.$firmaImagen->firmaImagen!!}" alt="" width="120px" style="margin-top:-50px">
                @break
                @case(2)
                    <img class="pull-right" src="{!!env('URL_BASE').'uploads/firmas/'.$firmaImagen->firmaImagen!!}" alt="" width="120px" style="margin-top:-30px">
                @default
                @break
            @endswitch
        </div>
    </div>

    @include('previews.header')

<body>
    @include('previews.contenido')
</body>
</html> --}}
