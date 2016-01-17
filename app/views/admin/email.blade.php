<?php $i=0; ?>

@extends('admin.layout')

@section('header')

   <script type="text/javascript" src="{{asset('vendors/ckeditor/ckeditor.js')}}"></script>

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



			<div class="form-group col-md-3">

				<div class="checkbox">

					<label for="{{'correos['.$i.']'}}">

						{{ Form::checkbox("to[".$i."]", $correo,true) }} <strong>{{$nombre}}</strong> <br> <small>{{$correo}} </small>

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

			<div class="form-group">

				{{ Form::label('file', 'Adjuntar Archivo:') }}

				{{Form::file('file',[])}}

				<small class="text-danger">{{ $errors->first('file') }}</small>

				<span class="label label-info">Suba un archivo Valido menor a 10Mb</span>

			</div>



			<div class="btn-group pull-right">

				{{ Form::submit("Enviar", ['id' => 'enviar','class' => 'btn btn-success']) }}

			</div>

			{{ Form::close() }}

		</div>

	</div>

</div>



<script type="text/javascript">
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