
@extends('layout')
@section('contenido')
<div class="container row">

	<div class="col m6 l6 s12">
		<ul class="collection with-header">
			<li class="collection-header center"> <h5>Tus Visitantes Frecuentes</h5></li>
			@forelse ($tusvisitantes as $visitante)
				<li class="collection-item">
					<strong>{{$visitante->nombre}}</strong>  <br>
					{{ Lang::get('literales.cedula') . ": ". number_format($visitante->cedula,0,",",".") }} <br>
					<small> Telefono: {{$visitante->telefono}}</small>
					<span class="secondary-content">
						@if ($visitante->residencia_id == Auth::user()->residencia_id)
							<a href="{{url("eliminar-visitante/".$visitante->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
						@else
							{{$visitante->residencia->nombre}} <br>
						@endif
					</span>
				</li>
			@empty
				<li class="collection-item">
					No Posees Visitantes Frecuentes
				</li>
			@endforelse
		</ul>
		<a class="waves-effect blue waves-light btn modal-trigger" href="#modalVisitante"><i class="fa fa-hand-peace-o left"></i> Agregar Visitante</a>
	</div>
	<div class="col m6 l6 s12">
		<ul class="collection with-header">
			<li class="collection-header center"><h5>Visitantes Frecuentes</h5></li>
			@forelse ($visitantes as $visitante)
				<li class="collection-item">
					<strong>{{$visitante->nombre}}</strong>  <br>
					{{ Lang::get('literales.cedula') . ": ". number_format($visitante->cedula,0,",",".") }} <br>
					<small class=""> Telefono: {{$visitante->telefono}}</small>
					<span class="secondary-content">
						@if ($visitante->residencia_id == Auth::user()->residencia_id)
							<a href="{{url("eliminar-visitante/".$visitante->id)}}" class="link"> <i class="fa fa-trash fa-2x"></i></a>
						@else
							 {{$visitante->residencia->nombre}}
						@endif
					</span>
				</li>
			@empty
				<li class="collection-item">
					No Hay Visitantes Frecuentes
				</li>
			@endforelse
		</ul>
	</div>

</div>

	<!-- Modal Visitante Estructura -->
	<div id="modalVisitante" class="modal">
		<div class="modal-content">
			<h4>Agregar Visitante</h4>
			{{ Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'url' => 'ver-visitantes']) }}
			<div class="input-field">
				{{Form::label('', "Nombre del Visitante")}}
				{{Form::text('nombre',null,['required' => 'required', 'min' => '6', 'length' => '50'])}}
				<small class="red-text">{{ $errors->first('nombre') }}</small>
			</div>
			<div class="input-field">
				{{Form::label('cedula', Lang::get('literales.cedula'))}}
				{{Form::number('cedula',null,['required' => 'required', 'min' => '3'])}}
				<small class="red-text">{{ $errors->first('nombre') }}</small>
			</div>
			<div class="input-field">
				{{Form::label('telefono', "Telefono")}}
				{{Form::text('telefono',null,['min' => '3', 'length' => '50'])}}
				<small class="red-text">{{ $errors->first('nombre') }}</small>
			</div>
			<div class="input-field">
				{{Form::label('email', "Email")}}
				{{Form::email('email',null,[ 'min' => '3', 'length' => '50'])}}
				<small class="red-text">{{ $errors->first('nombre') }}</small>
			</div>
		</div>
		<div class="modal-footer">
			<div class="btn-group pull-right">
				{{ Form::submit("Agregar Visitante", ['class' => 'btn']) }}
			</div>
			{{ Form::close() }}
		</div>
	</div>
@stop
