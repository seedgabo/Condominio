@extends('layout')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="col s12 m12">
			<div class="card blue-grey">
				<div class="card-content white-text">
					<h5 class="text-center">USUARIO CREADO CON ÉXITO</h5>
					<p class=""><i class="fa fa-info"></i> Muy Bien! Ya casi estamos listos! solo completa estos ultimos datos para activar tu cuenta</p>
				</div>
			</div>
		</div>

		{{ Form::open(['method' => 'POST', 'class' => 'form-horizontal col m12 l12 s12']) }}

		<div class="input-field">
			{{ Form::text('keycode', null, ['class' => 'form-control', 'required' => 'required']) }}
			{{ Form::label('keycode', 'Codigo de Condominio') }}
			<small class="red-text">{{ $errors->first('keycode') }}</small>
		</div>

		<div class="">
			{{ Form::label('residencia_id', 'Residencia:') }}
			{{ Form::select('residencia_id', $residencias, null,['class' => '', 'required' => 'required',]) }}
			<small class="red-text">{{ $errors->first('residencia_id') }}</small>
		</div>
				<br><br> <br>
		<strong class="indigo-text"> <i class="fa fa-warning"></i> Opcionalmente,tambien puedes establecer una contraseña:</strong>
		<div class="input-field">
			{{ Form::password('password', null, ['class' => 'form-control']) }}
			{{ Form::label('password', 'Contraseña') }}
			<small class="red-text">{{ $errors->first('password') }}</small>
		</div>

		{{ Form::submit("Completar Registro", ['class' => 'btn col s12 m12 l12']) }}
		{{ Form::close() }}
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('select').material_select();
	});
</script>
@stop