
@extends('layout')
@section('contenido')
<div class="container row">

	<div class="col m6 l6 s12">
		<ul class="collection with-header">
			<li class="collection-header center"> <h4>Tu Personal</h4></li>
			@forelse ($tupersonal as $persona)
			<li class="collection-item">
				<strong>{{$persona->nombre}}</strong>  <br>
				{{"Telefono: ".$persona->telefono}} <br>
				<small> {{$persona->cargo}}</small>
				<span class="secondary-content">
					@if ($persona->residencia_id == Auth::user()->residencia_id)
					<a href="{{url("eliminar-personal/".$persona->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
					@else
					{{Residencias::find($persona->residencia_id)->nombre }} <br>
					@endif
				</span>
			</li>
			@empty
			<li class="collection-item">
				No Posees Personal
			</li>
			@endforelse
		</ul>
		<a class="waves-effect blue waves-light btn modal-trigger" href="#modal1">Agregar Personal</a>
	</div>
	<div class="col m6 l6 s12">
		<ul class="collection with-header">
			<li class="collection-header center"> <h4>Todo El Personal</h4></li>
			@forelse ($personal as $persona)
			<li class="collection-item">
				<strong>{{$persona->nombre}}</strong>  <br>
				{{"Telefono: ".$persona->telefono}} <br>
				<small> {{$persona->cargo}}</small>
				<span class="secondary-content">
					@if ($persona->residencia_id == Auth::user()->residencia_id)
					<a href="{{url("eliminar-personal/".$persona->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
					@else
					{{Residencias::find($persona->residencia_id)->nombre }} <br>
					@endif
				</span>
			</li>
			@empty
			<li class="collection-item">
				No Posees Personal
			</li>
			@endforelse
		</ul>
	</div>

</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
	<div class="modal-content">
		<h4>Agregar Personal</h4>
		{{ Form::open(['method' => 'POST', 'class' => 'form-horizontal']) }}
		<div class="input-field">
			{{Form::label('nombre', "Nombre Completo de la Persona")}}
			{{Form::text('nombre',null,['required' => 'required', 'min' => '6', 'length' => '50'])}}
			<small class="red-text">{{ $errors->first('nombre') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('cedula', "Cedula de la Persona")}}
			{{Form::number('cedula',null,['required' => 'required'])}}
			<small class="red-text">{{ $errors->first('cedula') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('telefono', "Telefono de la Persona")}}
			{{Form::text('telefono',null,['required' => 'required','min' => '7'])}}
			<small class="red-text">{{ $errors->first('telefono') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('cargo', "Cargo o Trabajo de la Persona")}}
			{{Form::text('cargo',null,['required' => 'required', 'min' => '6', 'length' => '30'])}}
			<small class="red-text">{{ $errors->first('cargo') }}</small>
		</div>
		<div class="input-field">
			{{Form::label('email', "Email de la Persona si posee")}}
			{{Form::email('email',null,[])}}
			<small class="red-text">{{ $errors->first('email') }}</small>
		</div>
	</div>
	<div class="modal-footer">
		<div class="btn-group pull-right">
			{{ Form::submit("Agregar Personal", ['class' => 'btn']) }}
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop
