@extends('layout')
@section("contenido")
<div class="container row">
	<h1 class="center-align"> Galeria </h1>
	@forelse ($imagenes as $imagen)
	<div class="col s12 m4 l3">
		<img class="materialboxed" width="100%" data-caption="{{strrchr($imagen,"/")}}"  src="{{asset("/images/galeria") . strrchr($imagen,"/")}}" />
	</div>
	@empty
	<p>No Hay imagenes. </p> 
	@endforelse
	
	<a href="{{url("agregar-imagen")}}" class="btn col s12 m12 l12 " title="Agregar Imagen"> Agrega una Imagen</a>		
	
</div>
@stop