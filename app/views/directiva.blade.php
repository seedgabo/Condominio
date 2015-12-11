@extends('layout') 
{{-- Comentario --}} 
@section('contenido')
<div class="row">
	<div class="col s12 m8 l8">
		  <h3 class="center">Directiva</h3>
		@include('vertabla')
	</div>
<div class="col s12 m4 l4">
<h3 class="center">Ubicación</h3>
	<div class="video-container">
			<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q={{Config::get('var.long')}}%2C{{Config::get('var.lat')}}&key=AIzaSyAtX8TzvItNE6y5l6pGvC2CNkDubM7uDdM" allowfullscreen></iframe>
  </div>
</div>
</div>
@stop