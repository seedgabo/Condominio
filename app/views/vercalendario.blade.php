@extends('layout')
@section('contenido')
<div class=" row">
	<div class="card hoverable  col  s12 m9 l9">
		<h2 class="teal-text center-align"> Calendario de Eventos</h2>
		<div id="calendar" class=""></div>
	</div>

	<a href="href{{url('agregar-evento')}}" class="btn col s12 hide-on-med-and-up"> Agregar Evento</a>

	<div class="col m3 l3 hide-on-small-only">
		<ul class="collection right-aligned red z-depth-3">
			<li class="collection-header center-align"> <h5> Proximos Eventos </h5></li>
			@forelse($proximos as $evento)
			<li class="collection-item ">
				<strong class="center-align">
					{{ $evento->razon }}    
				</strong>
				<p>					
					<?php  setlocale(LC_TIME, 'es_CO'); ?>
					{{traducir_fecha(Carbon::parse($evento->fecha_ini)->formatLocalized('%a %d %b %y'))}} -
					{{traducir_fecha(Carbon::parse($evento->fecha_fin)->formatLocalized('%a %d %b %y'))}}
				</p>  
				<p class="red-text">{{traducir_fecha(Carbon::now()->diffForHumans(Carbon::parse($evento->fecha_ini . $evento->tiempo_ini))) }}</p>
				<p>{{$evento->areas}}</p>
				<blockquote class="right-align">
					{{$evento->persona}}
				</blockquote>
			</li>
			@empty
			<li class="collection-item">No hay Eventos</li>
			@endforelse
		</ul>
		<a href="{{url('agregar-evento')}}" class=" col m12 l12 btn"> Agregar Evento</a>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#calendar').fullCalendar({
			editable: false,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			theme : false,
			lang: 'es',
			defaultDate: '{{$time::now()}}',
		eventLimit: true, // allow "more" link when too many events
		events:{{$eventos}}
	})
	});
</script>
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.2/fullcalendar.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.2/lang/es.js"></script>
@stop