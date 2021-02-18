{!!Form::open(['route'=>'informe.index','method'=>'GET','class'=>'navbar-form navbar-left pull-rigth','role'=>'search'])!!}
	<div class="form-group">
	{!! Form::text('informe',null,['class'=>'form-control','placeholder'=>'Buscar informe por nombre de paciente o n° protocolo'])!!}
	</div>

	<button type="submit" id="buscar" class="btn btn-primary" onclick="fcn()">Buscar</button>
{!! Form::close() !!}