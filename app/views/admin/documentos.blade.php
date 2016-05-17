<?php $i ='A'; ?>
@extends('admin.layout')
@section('header')

@stop
@section('content')
    <h2>Documentos Dinámicos</h2>
    <ul class="list-group">
        @forelse ($documentos as $documento)
            <li  class="list-group-item">
                {{$documento->titulo}}
                <div class="btn-group " role="group">
                    <a class="btn btn-primary btn-xs" href="{{url('admin/editar-documento-dinamico/'.$documento->id)}}"><i class="fa fa-pencil"></i> Editar </a>
                    <a class="btn btn-default btn-xs" href="{{url('admin/cambiar-documento-dinamico/'.$documento->id)}}"> @if($documento->activo == 1) <i class="fa fa-check-square text-sucess"></i> Activado @else <i class="fa fa-square text-warning"></i> Desactivado  @endif </a>
                        <a class="btn btn-danger btn-xs" onclick="return confirm('Desea Eliminar este elemento');" href="{{url('admin/eliminar-documento-dinamico/'.$documento->id)}}"><i class="fa fa-trash"></i> Eliminar </a>
                    </div>
                </li>
            @empty
                <h4> No Hay documentos Dinamicos Generados</h4>
            @endforelse
        </ul>
        <a class="btn btn-primary" href="{{url('admin/agregar-documento-dinamico')}}"> <i class="fa fa-plus"></i> Agregar Documento Dinámico</a>




        <br> <br> <br> <br> <br> <br>
        <h2>Documentos Clásicos</h2>

        <ul class="list-group">
            @forelse ($files as $file)
                @if (substr(strrchr($file,'/'),1)=="index.html")
                    <?php continue ?>
                @endif
                <li id ="{{$i}}" class="list-group-item">
                    {{link_to_asset('docs/'.substr(strrchr($file,'/'),1), substr(strrchr($file,'/'),1), $attributes = array('class'=> 'btn btn-default btn-xs'))}}
                    <a href="#" onclick="eliminardocumento('{{substr(strrchr($file,'/'),1)}}','#{{$i++}}')" class="btn btn-danger btn-xs" role="button"><i class="fa fa-trash"></i> Eliminar</a>
                </li>
            @empty
                <h4> No Hay documentos Cargados</h4>
            @endforelse
        </ul>

        <div class="panel panel-default">
            <div class="panel-body">

                {{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal'])}}

                <div class="form-group">
                    {{ Form::label('file', 'Cargar un documento')}}
                    {{ Form::file('file', ['class' => 'required'])}}
                    <small class="text-danger">{{ $errors->first('file') }}</small>
                </div>

                <div class="btn-group pull-left">
                    {{ Form::submit("Subir", ['class' => 'btn btn-success'])}}
                </div>
                {{ Form::close() }}
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
