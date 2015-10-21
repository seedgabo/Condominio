@extends('layout')
@section('contenido')
<div class="container">
	
<ul class="collapsible" data-collapsible="expandable">
	@forelse ($noticias as $noticia)
	<li>
		<div class="collapsible-header  active">
		 <strong>{{$noticia->titulo}}</strong>
		</div> 
		<div class="collapsible-body row">
			<div class="col s2 m2 ml2">
				<img src="images/noticias/{{$noticia->media or '../logo.png'}}" alt="" data-caption="{{$noticia->titulo}}" class="circle materialboxed" height="100">
			</div>
			<div class="col s10 m10 l10">
				<p>{{$noticia->contenido}} <br>
				<blockquote>Por: {{ $noticia->persona or 'Condominio' }}</blockquote>
				</p>
			</div>
		</div>
	</li>
	@empty
	No hay Noticias
	@endforelse
</ul>
</div>
<div class="container row">
	<a href="{{url("agregar-noticia")}}" type="button" class=" btn-large col s12 m12 l12"><i class="fa fa-newspaper-o"></i> Agregar Noticia</a>
</div>
@stop