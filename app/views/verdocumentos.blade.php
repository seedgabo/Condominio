@extends('layout')
@section('contenido')
<div class="container">
	<div class="row">
	<div class="col m6">
		<h4 class="center">Documentos Generables</h4>
		<ul class="collection">
			@forelse ($documentos as $documento)
			<li class="collection-item">
			<i class="fa fa-lg left fa-file-pdf-o red-text"></i>
			<span class="title center">{{$documento->titulo}}</span>
				<span class="secondary-content">
					<a target="_blank" href="{{url('generar-documento/'.$documento->id)}}"> Descargar <i class="fa fa-lg fa-download"></i></a> |
					<a href="#" onclick="$('#iframe1').attr('src','{{url('generar-documento/'.$documento->id)}}')"> Ver <i class="fa fa-lg fa-eye"></i></a>
				</span>
			</li>
			@empty
			No Hay documentos Generados
			@endforelse
		</ul>

		<h4 class="center">Documentos Clásicos</h4>
		<ul class="collection">
			@if (count($docs) <= 1)
			<h3>NO HAY DOCUMENTOS CARGADOS</h3>
			@endif
			@forelse ($docs as $doc)
			@if (substr(strrchr($doc,'/'),1)=="index.html")
			<?php continue ?>
			@endif
			<li class="collection-item ">
			<i class="fa fa-lg left fa-file-pdf-o red-text"></i>
			<span class="title center">{{ substr(strrchr($doc,"/"),1)}}</span>
				<span class="secondary-content">
					<a href="{{asset('docs'. strrchr($doc,"/"))}}"> Descargar <i class="fa fa-lg fa-download"></i></a>
					<a href="#!" onclick="$('#iframe1').attr('src','{{asset('docs'. strrchr($doc,"/"))}}')"> Ver <i class="fa fa-lg fa-eye"></i></a>
				</span>
			</li>
			@empty
			No Hay documentos
			@endforelse
		</ul>

	</div>
	<div class="col m6">
		<br>
		<br>
		<br>
		<iframe id="iframe1" src="" frameborder="1" height="320px" width="100%"></iframe>
	</div>
	</div>
</div>
@stop
