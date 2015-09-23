@extends('layout')
@section('contenido')

<div class="card">
	<div class="container">
		<h2 class="center">Tus Datos</h2>
		{{ Form::model(Auth::user(),['method' => 'Post', 'class' => 'form-horizontal']) }}
		<div class="input-field">
			{{ Form::label('nombre', 'Nombre Completo:') }}
			{{ Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required','length'=>'30']) }}
			<small class="red-text">{{ $errors->first('nombre') }}</small>
		</div>
		<div class="input-field">
			{{ Form::label('email', 'Email adress') }}
			{{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'ej: foo@bar.com']) }}
			<small class="red-text">{{ $errors->first('email') }}</small>
		</div>
		{{ Form::label('residencia_id', 'Elija su Residencia') }}
		<div class="input-field">
			{{ Form::select('residencia_id', $residencias, null, ['class' => '', 'required' => 'required']) }}
			<small class="text-danger">{{ $errors->first('residencia_id') }}</small>
		</div>
		<div class="pull-right">
			{{ Form::submit("Actualizar", ['class' => 'btn blue']) }}
		</div>

		{{ Form::close() }}
	</div>
</div>
<div class="card">
 <h2 class="center">Tu Residencia</h2>
	<div class="container">
		{{ Form::model(Residencias::find(Auth::user()->residencia_id),['method' => 'Post','url' =>'editar-residencia', 'class' => 'form-horizontal']) }}
		<div class="input-field">
			{{ Form::label('nombre', 'Nombre de Residencia:') }}
			{{ Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required','length'=>'30']) }}
			<small class="red-text">{{ $errors->first('nombre') }}</small>
		</div>
		<div class="input-field">
			{{ Form::label('cant_personas', 'Cantidad de Personas') }}
			 {{Form::number('cant_personas', null, ['max' => '20' , 'min' => '0'])}}
			<small class="red-text">{{ $errors->first('cant_personas') }}</small>
		</div>

		{{ Form::label('persona_id_propietario', 'Propietario:') }}
		{{ Form::select('persona_id_propietario',User::where("residencia_id","=",Auth::user()->residencia_id)->lists('nombre','id'),Residencias::find(Auth::user()->residencia_id)->persona_id_propietario ,["class" => "browser-default"])}}
		<small class="red-text">{{ $errors->first('persona_id_propietario') }}</small>
			
		<div class="pull-right">
			{{ Form::submit("Actualizar", ['class' => 'btn blue']) }}
		</div>
		{{ Form::close() }}
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('select').material_select();
	});
</script>
@stop