    <div class="footer">
     <div class="row">
      <div class="col-xs-2"> Página <b> <span class="page-number"></span>  </b></div>
      <div class="col-xs-7 col text-justify" style="margin-left:0%;">
           <b><i>San Juan 481 – Salta Capital (4400) – Tel:+54 (0387) – 154084165 <br>
                laboratoriointegralsalta@gmail.com.    <br>
		        Director Técnico: Bioq. José Ignacio Leguizamón. – MP: 852 </i></b>
      </div>
      <div class="col-xs-2 text-left"> <img src="{!!env('URL_BASE').'img/qr.png'!!}" alt="" width="55px"></div>
     </div>
    </div>

    <div class="header">
        <div class="row">
            <div class="col-xs-12 top">
                <img src="{{env('URL_BASE_UPLOADS').'/membreteizq.png'}}" alt="" width="35%" style="margin-left:-10px">
                <img src="{{env('URL_BASE_UPLOADS').'/membreteder.png'}}" alt="" width="45%" style="margin-left:175px">
                <hr class="linea1"> <br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
            <b>NOMBRE:</b> {{ conv_tildes(ucfirst($pac->apellido))}} {{ conv_tildes(ucfirst($pac->nombre))}} <br>
                Documento: {{ condni($pac) }} <br>
                Médico: {{  conv_tildes(ucwords($doc->apellido))}} {{  conv_tildes(ucwords($doc->nombre))}}
            </div>

            <div class="col-xs-3">
                Edad: {!! $pac->edad !!} años<br>
                Fecha: {!! $fecha !!}<br>
                OS: {!! $os !!}
            </div>

            <div class="col-xs-2">
            <b>N° de Pedido: {!! $protocolo !!}</b><br>
            </div>

            <div class="col-xs-3">
                <img src="{{env('URL_BASE_UPLOADS').'/logo sin nombre.png'}}" alt="" width="40%" style="margin-top:-4px">
            </div>
        </div>
        <hr class="linea1">
    </div>
