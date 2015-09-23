@extends('layout')
 @section("head")
        <script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
 @stop
 @section('contenido')
<div class="container">
    {{ Form::open(['method' => 'POST','files'=>true]) }}
    <h2>Agregar Noticia</h2>
    <div class="input-field col s12">
        <input id="titulo" type="text" name="titulo" length="30" required="" class="validate">
        <label for="titulo">Titulo</label>
       <small class="red-text">{{ $errors->first('titulo') }}</small>
    </div>

        <label for="contenido">Contenido</label>
        <textarea id="contenido" name="contenido" length="10000" required="" class="ckeditor"></textarea>
        <small class="red-text">{{ $errors->first('contenido') }}</small>
    
    <input type="file" name="media" class="" accept="image/*" />
    <small class="red-text">{{ $errors->first('media') }}</small>
    <br>
    <br>
    <button type="submit" class="btn waves-effect waves-light"> Enviar <i class="mdi-content-send right"></i></button>
    {{ Form::close() }}
</div>
@stop
