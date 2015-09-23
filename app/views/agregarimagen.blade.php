@extends('layout')
@section ("contenido")

<div class=" container">
	<div class="card">
		<h4 class="center-align">Subir Imagen</h4>
		<p>Eliga un archivo imagen para mostrarla en la galeria</p>
		<p class="red-text"> Tenga cuidado con lo que suba, sera visible para todos los usuarios</p>
		{{ Form::open(['method' => 'POST','files' => true , 'class' => 'form']) }}

		<div class="file-field input-field">
			<input class="file-path validate" type="text"/>
			<div class="btn">
			<span>imagen</span>
				<input type="file"  name="file" accept="image/*" />
				<small class="red-text">{{ $errors->first('file') }}</small>
			</div>
		</div>

		<div class=" pull-right">
			{{ Form::submit("Subir", ['class' => 'btn']) }}
		</div>

		{{ Form::close() }}
	</div>
</div>
@stop