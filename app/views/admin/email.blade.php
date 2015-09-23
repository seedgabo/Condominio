<?php $i=0; ?>
@extends('admin.layout')
@section('header')
	<script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
@stop

@section('content')
<div class="container-fluid" role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#personas" aria-controls="personas" role="tab" data-toggle="tab">Personas</a>
		</li>
		<li role="presentation">
			<a id="emailtab" href="#email" aria-controls="email" role="tab" data-toggle="tab">Email</a>
		</li>
	</ul>
	
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane  active" id="personas">
			<div class="col-md-12">
				<a onclick="selectall()" class="btn">Seleccionar Todos</a>
				<a onclick="unselectall()" class="btn">Quitar Todos</a>
				<a class="btn btn-flat btn-block" onclick="$('#emailtab').trigger('click')" >Siguiente</a>
			</div>
			{{ Form::open(['method' => 'POST','url' => 'ajax/email','files' => true , 'class' => 'form']) }}
			@foreach ($correos as $nombre => $correo)

			<div class="form-group col-md-4">
				<div class="checkbox">
					<label for="{{'correos['.$i.']'}}">
						{{ Form::checkbox("to[".$i."]", $correo,true) }} <strong>{{$nombre}}</strong> <small>{{$correo}} </small>
					</label>
				</div>
				<small class="text-danger">{{ $errors->first("to[". $i++ ."]") }}</small>
			</div>
			@endforeach
			<div class="col-md-12">
				<a onclick="selectall()" class="btn">Seleccionar Todos</a>
				<a onclick="unselectall()" class="btn">Quitar Todos</a>
				<a class="btn btn-primary btn-lg btn-block" onclick="$('#emailtab').trigger('click')" >Siguiente</a>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="email">
			<div class="form-group">
				{{ Form::label('title', 'Titulo Del Mensaje:') }}
				{{ Form::text('title', "", ['class' => 'form-control', 'required' => 'required']) }}
				<small class="text-danger">{{ $errors->first('title') }}</small>
			</div>    

			<div class="form-group">
				{{ Form::label('contenido', 'Contenido del Mensaje:') }}
				{{ Form::textarea('contenido', "", ['id' => 'ckeditor', 'class' => 'ckeditor', 'required' => 'required']) }}
				<small class="text-danger">{{ $errors->first('contenido') }}</small>
			</div>	

			<div class="btn-group pull-right">
				{{ Form::submit("Enviar", ['class' => 'btn btn-success']) }}
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>

<div class="modal fade" id="notice">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Mensaje</h4>
			</div>
			<div class="modal-body">
				<p id="message"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$( "form" ).on( "submit", function( event ) {
			event.preventDefault();
			// actualizando datos de ckEDitor
			for(var instanceName in CKEDITOR.instances)
				CKEDITOR.instances[instanceName].updateElement();
			
			var data = $('form').serialize();
			jQuery.ajax({
				url: '{{url("ajax/email")}}',
				type: 'POST',
				data,
				datatype: 'json',
				beforeSend: function()
				{
					$('#notice').modal('show');
					$('#message').html('<i class="fa fa-pulse fa-spinner fa-5x"></i><br> Puede Tardar unos Minutos');
				},
				success: function(datos, textStatus, xhr) {
					//abriendo modal para imprimir datos
					$('#message').html($.parseJSON(datos).message);
					//borrando inputs si el status fue un ok
					if($.parseJSON(datos).status =="ok")
					{
						//limpiando instancias  del CKEDITOR
						for ( instance in CKEDITOR.instances ){
							CKEDITOR.instances[instance].updateElement();
						}
						CKEDITOR.instances[instance].setData('');

						
						$(':text').val(null);
						$('textarea').html("");
						$(':checkbox').prop('checked',false);
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("error: " .errorThrown);
				}
			});
		});
});

function selectall()
{
	var checkboxes = $(':checkbox');
	checkboxes.prop('checked', true);
}
function unselectall()
{
	var checkboxes = $(':checkbox');
	checkboxes.prop('checked', false);
}
</script>
@stop

