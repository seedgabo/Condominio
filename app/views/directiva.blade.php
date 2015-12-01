@extends('layout') 
{{-- Comentario --}} 
@section('contenido')
	@include('vertabla')
	<br>
	<div class="container video-container">
			<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q={{Config::get('var.long')}}%2C{{Config::get('var.lat')}}&key=AIzaSyAtX8TzvItNE6y5l6pGvC2CNkDubM7uDdM" allowfullscreen></iframe>
  </div>
@stop