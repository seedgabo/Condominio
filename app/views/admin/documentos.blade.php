<?php $i ='A'; ?>
@extends('Admin.layout')
@section('header')

@stop
@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Agregar un Documento</h3>
  </div>
  <div class="panel-body">
   {{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal'])}}

   <div class="form-group">
    {{ Form::label('file', 'Eliga una documento')}}
    {{ Form::file('file', ['class' => 'required'])}}
    <small class="text-danger">{{ $errors->first('file') }}</small>
  </div>

  <div class="btn-group pull-left">
   {{ Form::submit("Subir", ['class' => 'btn btn-success'])}}
 </div>
 {{ Form::close() }}
</div>
</div>



<ul class="list-group">
  @forelse ($files as $file)
    @if (substr(strrchr($file,'/'),1)=="index.html")
    <?php continue ?>
    @endif
  <li id ="{{$i}}" class="list-group-item">
   {{link_to_asset('docs/'.substr(strrchr($file,'/'),1), substr(strrchr($file,'/'),1), $attributes = array('class'=> 'btn btn-primary'), $secure = null)}}
   <a href="#" onclick="eliminardocumento('{{substr(strrchr($file,'/'),1)}}','#{{$i++}}')" class="btn btn-danger" role="button">Borrar</a> 
 </li>
 @empty
 <h2> No Hay documentos Cargadas</h2>
 @endforelse
</ul>

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
  function eliminardocumento(path,selector)
  {
    jQuery.ajax(
    {
      url: '{{url("admin/Documentos")}}',
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