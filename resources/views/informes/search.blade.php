{!!Form::open(['route'=>'informe.create','method'=>'GET','class'=>'navbar-form navbar-left pull-rigth','role'=>'search'])!!}
	<div class="form-group">
	{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Buscar paciente por DNI'])!!}
	</div>

	<button type="submit" id="buscar" class="btn btn-primary" onclick="fcn()">Buscar</button>
{!! Form::close() !!}