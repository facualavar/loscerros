<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap-pdf.css">
    <title>tapa</title>

    <style>
        .rectangulo {
            width: 91%;
            border: 2px solid #555;
            padding-left: 10px;
            font-size: 14px;
        }
        .caja2{
            margin-left: 8%;
            margin-top: 1%;
        }
        .margen{
            margin-top: 45%;
        }
    </style>
</head>
<body>
    <div class="margen"><br></div>
    <div class="text-center"><img src="{{env('URL_BASE_UPLOADS').'/portadaAni.png'}}" alt="" width="100%"></div>
     
    <div class="caja2"><div class="rectangulo"><b>PACIENTE:</b>  {{ conv_tildes(strtoupper($pac->apellido))}} {{ conv_tildes(strtoupper($pac->nombre))}}   <b style="margin-left: 25%; display: block; margin-left: 74%; margin-top: -23px;">Protocolo Nº: {{$id}}</b></div></div>
    <br>
    <div class="caja2">
        <b>Fecha: </b> {{$fecha}} <br>
        <b>OS:</b> {{$pac->obra}} <br>
        <b>Médico:</b> {{  conv_tildes(ucwords($doc->apellido))}} {{  conv_tildes(ucwords($doc->nombre))}} <br>
        @if($pac->diagnostico!='') 
            <b>Diagnóstico:  {{$pac->diagnostico}}</b>
        @endif
    </div>
</body>
</html>