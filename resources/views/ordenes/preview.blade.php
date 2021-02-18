<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <base href="{{env('APP_URL')}}">
    <link rel="stylesheet" href="dist/css/bootstrap-pdf.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <title>Informe - {{env('NAME_COMPANY')}}</title>
</head>
<style>
    .header {
        top: 0px;
        position: fixed;
        width: 100%;
    }

    body { margin-top: 35px; font-size: 11px; }
</style>
<body>
    @if($obra!='d')
        <h4 class="header"> Ordenes del {{$fecha1}} hasta {{$fecha2}}
            @switch($obra)
                @case(1)
                    IPSS
                    @break
                @case(2)
                    PAMI
                    @break
                @case(68)
                    PARTICULARES
                    @break
                @default

            @endswitch
        </h4>
        <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th>#Informe</th>
                        @if($obra==0)<th>Obra y Paciente</th> @endif
                        <th>Analisis</th>
                        <th>Fecha</th>
                        <th>Precio Part.</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{!!$d->idInforme!!}</th>
                        @if($obra==0)
                            <td>
                                {!!$d->obra!!} <br>
                                <b>{!!$d->paciente!!}</b>
                            </td>
                        @endif
                        <td>{!!saltos($d->analisis)!!}</td>
                        <td>{!!$d->fecha!!}</td>
                        <td>$ {!!$d->precio!!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    @else
        <h4 class="header"> Ordenes del {{$fecha1}} hasta {{$fecha2}} Deudores  </h4>
        <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>#Informe</th>
                        <th>Paciente - Obra Social</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $d)
                    <tr><td>{!!$d->fecha!!}</td>
                        <td>{!!$d->idInformes!!}</th>
                        <td><b>{!!$d->paciente!!}</b><br>
                               {!!$d->obra!!} </td>
                        <td>{!!$d->observaciones!!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    @endif
</body>
</html>
