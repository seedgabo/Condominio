@extends('admin/layout')
@section('content')
<br>
<div class="">
	<div class="well col-md-12">
		<h4>Enviar mensaje a Aplicación Android <span class="bg-primary badge">Beta</span> <span class="badge">Nuevo</span></h4>
		 {{ Form::open(['method' => 'post', 'action' => 'AdminController@push', 'class' => 'form-inline']) }}

		    <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
		        {{ Form::label('titulo', 'Titulo') }}
		        {{ Form::text('titulo', null, ['class' => 'form-control', 'required' => 'required']) }}
		        <small class="text-danger">{{ $errors->first('titulo') }}</small>
		    </div>

			<div class="form-group{{ $errors->has('mensaje') ? ' has-error' : '' }}">
			    {{ Form::label('mensaje', 'Mensaje') }}
			    {{ Form::text('mensaje', null, ['class' => 'form-control', 'required' => 'required']) }}
			    <small class="text-danger">{{ $errors->first('mensaje') }}</small>
			</div>

		     <div class="form-group">
		         {{Form::submit("Enviar Mensaje", ['class' => 'btn btn-success']) }}
		     </div>
		 {{ Form::close() }}
	</div>
	<div class="well col-md-12">
		@include('charts/graficoDeRecibosPorMes');
	</div>
	<div class="well col-md-12">
		@include('charts/cantidadDeUsuariosPorViviendaPromedio');
	</div>
	<div class="well col-md-6">
		@include('charts/cantidadDeUsuariosPorMorosidad');
	</div>
		<div class="well col-md-6">
		@include('charts/facturacionPorConcepto');
	</div>
</div>
@stop
