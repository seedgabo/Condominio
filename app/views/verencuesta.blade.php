@extends('layout')
@section('head')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
@stop
@section('contenido')
<h1 class="center">Encuestas</h1>
<div class="container row">
	<div class="col s12 m6 l6">
		<div class="encuestasLista" class="card center">
			<ul class="collection with-header">
				<li class="collection-header"> <h4>Encuestas:</h4></li>
				@forelse ($encuestas as $encuesta)
				<a onclick="cargarGrafico({{$encuesta->id}})" class="collection-item">
					{{$encuesta->pregunta}}
				</a>
				@empty
				<li class="collection-item"> NO HAY ENCUESTAS</li>
				@endforelse
			</ul>
		</div>
	</div>
	<div class="col s12 m6 l6">
		<div id="grafico" class="card z-depth-4 center"></div>
	</div>
</div>

<script>
	$(document).ready(function()
	{
		cargarGrafico({{$encuestas['0']->id}});  
	});
	function cargarGrafico(id)
	{
		$.ajax({
			beforeSend: function ()
			{

			},
			url: '{{url("ajax/resultados-encuesta/")}}' +"/"+id,
			success: function(data)
			{
				$("#grafico").html(data);
				$('.modal-trigger').leanModal({
			      dismissible: true, // Modal can be dismissed by clicking outside of the modal
			      opacity: .5, // Opacity of modal background
			      in_duration: 300, // Transition in duration
			      out_duration: 200, // Transition out duration
			  });  
			},
			complete : function()
			{
				$( "#respuestaform" ).submit(function( e ) {
					e.preventDefault();
					enviarRespuesta(id);
				});	 
			},
		});
	}

	function enviarRespuesta(id)
	{

		$.ajax({
			beforeSend: function ()
			{
				$("#respuestaform").append('<div class="progress"> <div class="indeterminate"></div> </div>') 
			},
			url: '{{url("ajax/resultados-encuesta/")}}' +"/"+id,
			data: {respuesta:$('input[name=respuesta]:checked').val(), persona_id:"{{Auth::user()->id}}" ,encuesta_id: $('input[name=encuesta_id]').val()},
			success: function(data)
			{
				$("#modal1").closeModal();
				cargarGrafico(data.encuesta_id);
			},
		});
	}
</script>	
@stop