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
			<li class="collection-item avatar">
				<img src="images/pdf.png" alt="" class="circle">
				<span class="title">{{ substr(strrchr($doc,"/"),1)}}</span>
				<p>Descargar: {{link_to('docs'. strrchr($doc,"/"), substr(strrchr($doc,"/"),1))}} </p> 
				<p class="secondary-content"> <i class="fa fa-2x fa-file-pdf-o"></i></p>
			</li>
			@empty
			No Hay documentos
			@endforelse
		</ul>
	</div>
</div>
@stop