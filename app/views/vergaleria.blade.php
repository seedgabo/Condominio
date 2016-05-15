@extends('layout')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('fotorama/fotorama.css')}}">
<script type="text/javascript" src="{{asset('fotorama/fotorama.js')}}"></script>
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
