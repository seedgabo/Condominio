@extends('layout')
@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js"></script>
@stop


@section("contenido")
<div class="container row">
	<h1 class="center-align"> Galeria </h1>
	<div data-width="100%" data-nav="thumbs" class="fotorama">
		
		@forelse ($imagenes as $imagen)
			<img class="" data-caption="{{substr(strrchr($imagen,"/"),1)}}"  src="{{asset("/images/galeria") . strrchr($imagen,"/")}}" />
		@empty
		<p>No Hay imagenes. </p> 
		@endforelse

	</div>
	<a href="{{url("agregar-imagen")}}" class="btn col s12 m12 l12 " title="Agregar Imagen"> Agrega una Imagen</a>		
	
</div>
@stop