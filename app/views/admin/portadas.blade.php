<?php 
	$portadas =DB::table('portadas')->get();
 ?>

@extends('admin.layout')
@section('content')
@forelse ($portadas as $portada)
	<div class="panel" style="background-image:url('{{url('images/portadas/' . $portada->media)}}'); color: white"> 
			<h2>{{$portada->titulo}}</h2>
			<p > {{$portada->contenido}}</p>
			<a href="{{url('admin/Diseño/Portada?id='.$portada->id)}}" class="btn btn-danger"> <i class="fa fa-trash"></i></a>

	</div>
@empty
	 NO Hay Portadas Agregadas
@endforelse

 
{{ Form::open(['method' => 'POST', "files" => true, 'class' => 'form-horizontal col-md-offset-3 col-md-6']) }}

    <div class="form-group">
        {{ Form::label('titulo', 'Titulo', ['class' => 'col-sm-3']) }}
    	<div class="col-sm-9">
        	{{ Form::text('titulo', null, ['class' => 'form-control', 'required' => 'required' , 'length' => 50]) }}
        	<small class="text-danger">{{ $errors->first('titulo') }}</small>
    	</div>
    </div>

    <div class="form-group">
        {{ Form::label('contenido', 'Contenido', ['class' => 'col-sm-3']) }}
        <div class="col-sm-9">
        	{{ Form::textarea('contenido', null, ['class' => 'form-control', 'required' => 'required' , 'length' => 500]) }}
        	<small class="text-danger">{{ $errors->first('contenido') }}</small>
    	</div>
    </div>

    <div class="form-group">
        {{ Form::label('media', 'Agrega una Imagen') }}
        {{ Form::file('media', ['class' => 'required', "required" => "required", "accept"=>"image/*"]) }}
        <small class="text-danger">{{ $errors->first('media') }}</small>
    </div>

    <div class="btn-group pull-right">
        {{ Form::submit("Agregar", ['class' => 'btn btn-success']) }}
    </div>
{{ Form::close() }}
@endsection



