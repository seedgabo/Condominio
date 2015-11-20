@extends('layout')
@section('contenido')
<div class="container">
	<div class="row">
		<ul class="collection">
			@if (count($docs) <= 1)
			<h3>NO HAY DOCUMENTOS CARGADOS</h3>
			@endif
			@forelse ($docs as $doc)
			@if (substr(strrchr($doc,'/'),1)=="index.html")
			<?php continue ?>
			@endif
			<li class="collection-item ">
			<i class="fa left fa-2x fa-file-pdf-o"></i> 
			<span class="title center">{{ substr(strrchr($doc,"/"),1)}}</span>
				<span class="secondary-content">
					Descargar: <i class="fa fa-download"></i> {{link_to('docs'. strrchr($doc,"/"), substr(strrchr($doc,"/"),1))}} 
				</span>
			</li>
			@empty
			No Hay documentos
			@endforelse
		</ul>
	</div>
</div>
@stop