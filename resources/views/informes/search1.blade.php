{!!Form::open(['route'=>'informe.create','method'=>'GET','class'=>'navbar-form navbar-left pull-rigth','role'=>'search'])!!}
	<div class="form-group">
	{!! Form::text('doctor',null,['class'=>'form-control','placeholder'=>'Buscar doctor por MATRICULA'])!!}
	</div>

	<button type="submit" id="buscar" class="btn btn-primary" onclick="fcn()">Buscar</button>
{!! Form::close() !!}