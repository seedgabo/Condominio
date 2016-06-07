@extends('layout')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.ptTimeSelect.css') }}">
<script src="{{ asset('js/jquery.ptTimeSelect.js') }}"></script>
@stop

@section('contenido')
{{ Form::open(['method' => 'POST', 'class' => 'container']) }}
<h2>Agregar Evento</h2>
	<label for="razon">Razón o Nombre del Evento</label>
	<input id="razon" name="razon" required="" type="text" placeholder="Fiesta, Reunión de Vecinos, Recepción , etc"></input>
	<small class="red-text">{{ $errors->first('razon') }}</small>

	<label for="Fecha_start"> Fecha de Inicio</label>
	<input id="Fecha_start" name="fecha_ini" type="date" value="{{$time::today()->toDateString()}}" required="" min="{{ $time::today()->toDateString()}}" class="validate">
	<small class="red-text">{{ $errors->first('fecha_ini') }}</small>

	<label for="time_ini"> Tiempo de Inicio</label> <br>
	<input id="time_ini" required="" name="tiempo_ini" value="{{$time::now()->format('h:i A')}}" class="time"> <br> <br>
	<small class="red-text">{{ $errors->first('tiempo_ini') }}</small>

	<label for="Fecha_End"> Fecha de Final</label>
	<input id="Fecha_End" name="fecha_fin" type="date" value="{{$time::tomorrow()->toDateString()}}" required="" min="{{ $time::today()->toDateString()}}" class="validate">
	<small class="red-text">{{ $errors->first('fecha_fin') }}</small>

	<label for="time_end"> Tiempo de Final</label> <br>
	<input id="time_end" required="" name="tiempo_fin"  class="time">
	<small class="red-text">{{ $errors->first('tiempo_fin') }}</small>
	<p>
	@foreach ($areas as $area)
		<input type="checkbox" class="" name="areas[]" id="{{$area->id}}" value="{{$area->id}}">
		<label for="{{$area->id}}"> {{$area->nombre}}</label>
	@endforeach
	</p>
	<button type="submit" class="btn  col m12 s12 l12">Enviar</button>
{{ Form::close() }}
<script>
	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	});
	$(document).ready(function(){
		$('.time').ptTimeSelect({
			containerClass: "card hoverable",
			containerWidth: "350px",
			setButtonLabel: "Seleccionar",
			minutesLabel: "min",
			hoursLabel: "Hrs",
		});
		$('#Fecha_start').change(function(){
			$('#Fecha_End').val($(this).val());
		})
		$('#time_end').focus(function(){
			$(this).val($('#time_ini').val());
		})
	});
</script>
@stop
