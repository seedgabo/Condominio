@extends('layout')
<?php $residencias= Residencias::lists("nombre","id"); ?>
@section('contenido')
<div class="container">
	<div class="row">
		{{-- Carta de Residencia --}}
		<div class="card  hoverable">
			<div class="card-image waves-effect waves-block waves-light">
				<img height="300" class="activator" src="{{asset('images/condominio/logo.png')}}">
			</div>
			<div class="card-content center-align activator">
				<span class="card-title  grey-text text-darken-4">
					<h2>{{ $residencia->nombre }}</h2>
					<p class="">Click en la Imagen para Ver los Detalles</p>
				</span>
			</div>
			<div class="card-reveal">
				<span class="card-title center-align grey-text text-darken-4">{{ $residencia->nombre}} <i class="mdi-navigation-close  right"></i></span>
				<p>
					@if ($residencia->solvencia)
						<h3 class="green-text">Al Día</h3>
					@else
						<h3 class="red-text"> Moroso</h3>
					@endif
					<strong>Nombre de la Residencia:</strong>  {{$residencia->nombre}} <br>
					@if (User::where('id','=',$residencia->persona_id_propietario)->first() != null)
					<strong>Dueño: </strong> <img height="24" class="circle" src="{{User::where('id','=',$residencia->persona_id_propietario)->first()->avatar}}" alt="Sin imagen">	{{$residencia->Dueño}}   <br>
					@endif
					<strong>Alicuota: </strong>	{{$residencia->alicuota}} % <br>
					<strong>Cantidad de Residentes: </strong>	{{$residencia->cant_personas}} <br>
				</p>
				<div class="divider"></div>
				<h5>Residentes:</h5>
				<ol>
					@forelse ($residentes as $residente)
					<li><img height="24" class="circle" src="{{$residente->avatar}}" alt="Sin imagen">{{$residente->nombre}}</li>
					@empty
					<li>No Hay Residentes Registrados</li>
					@endforelse
				</ol>
				<div class="divider"></div>
				<h5>Personal:</h5>
				<ol>
					@forelse ($personal as $persona)
					<li>{{$persona->nombre}} <small>{{$persona->cargo}}</small></li>
					@empty
					<li>No Hay Personal Registrado</li>
					@endforelse
				</ol>
			</div>
		</div>

		{{ Form::open(['method' => 'GET', 'url' => 'ver-residencia', 'class' => 'form-horizontal']) }}
		<h5>Ver Datos de Residencia:</h5>
		<div class="">
			{{ Form::label('residencia', 'Residencia:') }}
			{{ Form::select('residencia', $residencias, Auth::user()->residencia_id,['class' => '', 'required' => 'required',]) }}
			<small class="red-text">{{ $errors->first('residencia') }}</small>
		</div>

		{{ Form::submit('Ver', ['class' => 'btn cyan']) }}
		{{ Form::close() }}
	</div>
</div>
@stop
