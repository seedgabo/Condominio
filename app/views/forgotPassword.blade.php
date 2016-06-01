@extends('layout')


@section('contenido')
<div class="container">
	<div class="card orange">
		 <h5><i class="fa fa-info"></i> Este formulario enviara un correo para reestablecer la contraseña</h5>
	</div>
<form action="{{ action('RemindersController@postRemind') }}" method="POST">
	<div class="input-field">
		<i class="material-icons prefix">account_circle</i>
		<input id="correo" type="text" name="email" class="validate">
		<label for="correo">Email</label>
	    <small class="text-danger">{{ $errors->first('email') }}</small>
	</div>
    <input type="submit" class="btn" value="Reestablecer contraseña">
</form>
</div>


@stop
