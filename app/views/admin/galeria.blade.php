<?php $i ='A'; ?>
@extends('Admin.layout')
@section('header')

@stop
@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Agregar Imagen</h3>
  </div>
  <div class="panel-body">
   {{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal'])}}

   <div class="form-group">
    {{ Form::label('file', 'Eliga una imagen')}}
    {{ Form::file('file', ['class' => 'required'])}}
    <small class="text-danger">{{ $errors->first('file') }}</small>
  </div>

  <div class="btn-group pull-left">
   {{ Form::submit("Subir", ['class' => 'btn btn-success'])}}
 </div>
 {{ Form::close() }}
</div>
</div>



@forelse ($files as $file)
<div id="{{$i}}"  class="thumbnail col-sm-6 col-md-3">
  <a href="{{ url('images/galeria/').strrchr($file,'/')}}" class="">
    <img class="" src="{{ url('images/galeria/').strrchr($file,'/')}}" alt="Imagen" >
  </a>
  <div class="caption">
   <h3>{{substr(strrchr($file,'/'),1)}}</h3>
   <p>
     <a href="{{ url('images/galeria/').strrchr($file,'/')}}" class="btn btn-primary" role="button">Ver</a>
     <a href="#" onclick="eliminarimagen('{{substr(strrchr($file,'/'),1)}}',{{$i++}})" class="btn btn-danger" role="button">Borrar</a> 
   </p>
 </div>
</div>
@empty
<h2> No Hay Imagenes Cargadas</h2>
@endforelse

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

<script>
  var x;
  function eliminarimagen(path,selector)
  {
    x = selector;
    jQuery.ajax(
    {
      url: '{{url("admin/Galeria")}}',
      type: 'POST',
      data: {path: path},
      complete: function(xhr, textStatus) {

      },
      success: function(data, textStatus, xhr) {
       $(selector).animate({
         opacity: 0.25,
         left: "+=50",
         height: "toggle"},
         1500, function() 
         {
          $(selector).remove();
        });
       $('#notice').modal('show');
       $('#message').html("Borrado Correctamente");
     },
     error: function(xhr, textStatus, errorThrown) {
       alert("No Se Pudo Eliminar la Imagen:\n Error:" + errorThrown);
     }
   });
  }
</script>
@stop