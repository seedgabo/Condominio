@extends('layout')
@section('contenido')
<div class="container">
	<div class="row">
		{{-- Carta de Residencia --}}
		<div class="card hoverable">
			<div class="card-image waves-effect waves-block waves-light">
				<img height ="500"  class="activator" src="images/home.png">
			</div>
			<div class="card-content center-align activator">
				<span class="card-title  grey-text text-darken-4">
					<h2>{{ $residencia->nombre}}</h2>
					<p class="red-text">Click en la Imagen para Ver los Detalles</p>
				</span>
			</div>
			<div class="card-reveal">
				<span class="card-title grey-text text-darken-4"><h1> {{ $residencia->nombre}} </h1><i class="mdi-navigation-close  right"></i></span>
				<p>
					@if ($residencia->solvencia)
						<h3 class="center-align green-text">Solvente</h3>
					@else
						<h3 class="center-align red-text"> Moroso</h3>	
					@endif
					<strong>Nombre de la Residencia:</strong>  {{$residencia->nombre}} <br>
					<strong>Dueño: </strong>	{{$residencia->Dueño}} <br>
					<strong>Alicuota: </strong>	{{$residencia->alicuota}} % <br>
					<strong>Cantidad de Residentes: </strong>	{{$residencia->cant_personas}} <br>
				</p>
				<div class="divider"></div>
				<h5>Residentes:</h5>	
				<ol>
					@forelse ($residentes as $residente)
					<li>{{$residente->nombre}}</li>
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
	</div>
</div>
@stop