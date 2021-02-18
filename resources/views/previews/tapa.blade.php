<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dist/css/bootstrap-pdf.css">
    <title>tapa</title>

    <style>
        body {
            /* A5 dimensions */
            height: 148.5mm;
            width: 210mm;
            margin: 0;
            padding: 0;
            font-size: 12px;
              font-family: sans-serif;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
        }
        page[size="A5"] {
            width: 148mm;
            height: 210mm;
        }
        page[size="A5"][layout="landscape"] {
            width: 148mm;
            height: 210mm;
        }

            @page {
                /* dimensions for the whole page */
            size: A5 landscape;
            width: 148mm;
            height: 210mm;
            }

        .rectangulo {
            width: 91%;
            border: 2px solid #555;
            padding-left: 10px;
            font-size: 13px;
        }
        .caja2{
            margin-left: 63px;
            margin-top: 0%;
        }
        .margen{
            margin-top: 50%;
        }
    </style>
</head>
<body class="A5">

    {{-- <div class="margen"><br></div>  --}}
    <div><br></div>
    {{-- <div class="text-center"><img src="{{env('URL_BASE_UPLOADS').'/tapa.png'}}" alt="" width="100%"></div>
    <div class="text-center"><img src="{{env('URL_BASE_UPLOADS').'/sub tapa.png'}}" alt=""></div>  --}}

    <div class="row caja2">
       <div class="col-xs-3 col align-self-start"><b>Nº de Pedido: {{$id}}</b> </div>
       <div class="col-xs-3 col align-self-start">Edad: {{$pac->edad}} años</div>
       <div class="col-xs-6 col align-self-start"><b>NOMBRE:</b>  {{  mb_strtoupper($pac->apellido)}} {{  mb_strtoupper($pac->nombre)}} </b></div>
    </div>

    <div class="row caja2">
       <div class="col-xs-3 col align-self-start"></div>
       <div class="col-xs-3 col align-self-start">Fecha: {{$fecha}} </div>
       <div class="col-xs-6 col align-self-start">Documento:  {{$pac->DNI}} </div>


    </div>

    <div class="row caja2">
       <div class="col-xs-3 col align-self-start"></div>
       <div class="col-xs-3 col align-self-start">Obra Social: {{$pac->obra}}</div>
       <div class="col-xs-6">Médico: {{  conv_tildes(ucwords($doc->apellido))}}, {{  conv_tildes(ucwords($doc->nombre))}}
    </div>

    {{--div style="margin-top:25px; margin-left:42%"><img src="{{env('URL_BASE_UPLOADS').'/tapa.png'}}" alt=""></div>  --}}
</body>
</html>
