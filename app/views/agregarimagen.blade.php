<?php $albums= Galeria::distinct()->lists('album') ?>

@extends('layout') 

@section ("contenido")

<div class=" container row">

    <h4 class="center-align">Subir Imagen</h4>
    <p>Eliga un archivo imagen para mostrarla en la galeria</p>
    <p class="red-text"> Tenga cuidado con lo que suba, sera visible para todos los usuarios</p>
    {{ Form::open(['method' => 'POST','files' => true , 'class' => '']) }}

    <div class="file-field input-field">
        <div class="btn">
            <span>Imagen</span>
            <input type="file" name="file" accept="image/*">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>
   

    <div class="input-field">
        <input name="nombre" id="nombre" type="text" required="required" maxlength="30" length="30" class="validate">
        <label for="nombre">Nombre de la Imagen</label>
    </div>

    <div class="input-field">
        <input name="album" list="albums" id="album" type="text" required="required" maxlength="30" length="30" class="validate" value="{{$albums[0] or ''}}">
        <label for="album">Nombre del Album</label>
    </div>


    <datalist id="albums">
    @forelse ($albums as $album)
      <option value="{{$album}}">
    @empty
    @endforelse
    </datalist>
    
    <div class="col offset-l4 l4">
        {{ Form::submit("Subir", ['class' => 'btn']) }}
    </div>
    {{ Form::close() }}
</div>
@stop
