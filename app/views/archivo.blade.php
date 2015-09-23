@extends('layout'); @section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            {{ Form::open(['method' => 'POST' ,'files' => true , 'url' => 'file' , 'class' => 'form-horizontal'] ) }}
            <div class="form-group">
                {{ Form::label('file', 'File label') }} 
                {{ Form::file('file', ['class' => 'required']) }}
                <small class="text-danger">{{ $errors->first('file') }}</small>
            </div>
            <div class="form-group">
                {{ Form::label('nombre', 'Input label') }} {{ Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) }}
                <small class="text-danger">{{ $errors->first('nombre') }}</small>
            </div>
            <div class="btn-group pull-right">
                {{ Form::reset("Reiniciar", ['class' => 'btn btn-warning']) }} 
                {{ Form::submit("Enviar", ['class' => 'btn btn-success']) }}
            </div>
            {{ Form::close() }}
            <p> {{ $path or 'no hay archivo'}}</p>
        </div>
    </div>
</div>
@stop
