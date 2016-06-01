@extends('layout')

@section('contenido')
<div class="container">

	<form action="{{ action('RemindersController@postReset') }}" method="POST">
	    <input type="hidden" name="token" value="{{ $token }}">

	 <div class="input-field">
		<i class="material-icons prefix">account_circle</i>
		<input id="correo" type="text" name="email" class="validate">
		<label for="correo">Email</label>
	    <small class="red-text">{{ $errors->first('email') }}</small>
	</div>

	<div class="input-field">
		<i class="material-icons prefix">security</i>
		<input id="password" type="password" name="password" class="validate">
		<label for="password">Contraseña</label>
	    <small class="red-text">{{ $errors->first('email') }}</small>
	</div>

	<div class="input-field">
		<i class="material-icons prefix">security</i>
		<input id="password_confirmation" type="password" name="password_confirmation" class="validate">
		<label for="password_confirmation">Confirmar Contraseña</label>
	    <small class="red-text">{{ $errors->first('email') }}</small>
	</div>

	    <input type="submit" class="btn btn-outline" value="Reestablecer Contraseña">
	</form>
</div>
@stop
