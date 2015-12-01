@extends('admin/layout')

@section('content')
	<div class="col-md-offset-3 col-md-6">
		
	{{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal']) }}
	
	    <div class="form-group @if($errors->first('file')) has-error @endif">
	        {{ Form::label('file', 'Archivo Excel') }}
	        {{ Form::file('file', ['required' => 'required', 'accept' => ".xls,.xlsx,application/vnd.ms-excel" ]) }}
	        <small class="text-danger">{{ $errors->first('file') }}</small>
	    </div>
	
	    <div class="btn-group pull-right">
	        {{ Form::submit("Importar", ['class' => 'btn btn-success']) }}
	    </div>
	
	{{ Form::close() }}

{{link_to('test?descargar=true')}}
	</div>
@stop