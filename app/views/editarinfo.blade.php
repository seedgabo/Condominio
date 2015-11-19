@extends('layout')
@section('contenido')

<div class="card">
	<div class="container">
		<h2 class="center">Tus Datos
		</h2>

		{{ Form::model(Auth::user(),['method' => 'Post', 'class' => 'form-horizontal row']) }}
		<div class="col l1 m2 s3">			
			<img src="{{Auth::user()->avatar}}" alt="Sin imagen" class="circle big-avatar">
		</div>
		<div class="input-field col l11 s9 m10">
			{{ Form::label('nombre', 'Nombre Completo:') }}
			{{ Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required','length'=>'30']) }}
			<small class="red-text">{{ $errors->first('nombre') }}</small>
		</div>
		<div class="input-field col l12 m12 s12 ">
			{{ Form::label('email', 'Email adress') }}
			{{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'ej: foo@bar.com']) }}
			<small class="red-text">{{ $errors->first('email') }}</small>
		</div>
		<div class="input-field col l12 m12 s12">
			{{ Form::select('residencia_id', $residencias, null, ['class' => '', 'required' => 'required']) }}
			<small class="text-danger">{{ $errors->first('residencia_id') }}</small>
		</div>
		<div class="col m12 l12 s12">
			{{ Form::submit("Actualizar", ['class' => 'btn blue']) }}
		</div>
		{{ Form::close() }}
	</div>
</div>

<br> <br>
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
		{{ Form::select('persona_id_propietario',User::where("residencia_id","=",Auth::user()->residencia_id)->lists('nombre','id'),Residencias::find(Auth::user()->residencia_id)->persona_id_propietario ,["class" => ""])}}
		<small class="red-text">{{ $errors->first('persona_id_propietario') }}</small>

		<div class="">
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