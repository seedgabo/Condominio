<?php
$meses = getMeses();
$i=0;
$query = "?" . http_build_query(Input::only('mes','año','residencia_id'));
$residencias_opt = Residencias::orderby("id")->where("nombre","<>","condominio")->lists("nombre","id");
?>
    @extends('admin.layout')
    @section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-chosen.css')}}">
    <script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
    @stop
    @section('content')

    <div id="info" class="jumbotron">
	    <div class="container">
					<p><button class="btn btn-info" type="button" onclick="$('#info').toggle('fast')"><i class="fa fa-eye"></i></button>
	        Este formulario permite asignar cuotas de manera masiva a las residencias </p>
	        <ul>
	            <li>Las cuotas son establecidas como particulares y por lo tanto el cobro se hace por el total del monto</li>
	            <li>Las cuotas asignadas se hacen de manera individual y puden ser visualizadas en el modulo de cuotas por residencias</li>
	        </ul>
          <a target="_blank" href="{{url('admin/Finanzas/generarResumendeCobrosMes')}}" class="btn btn-success">Ver Resumen de Cobros Mensual</a>
	    </div>
		</div>

     <div class="well">
     		<button class="btn" onclick="$('form#crear').toggle('fast')"><i class="fa fa-eye"></i></button>
		    {{ Form::open(['method' => 'POST','id' =>'crear' , 'class' => 'form-horizontal']) }}

			    <div class="form-group @if($errors->first('mes')) has-error @endif">
			        {{ Form::label('mes', 'Mes:', ['class' => 'col-sm-3 control-label']) }}
			        <div class="col-sm-6">
			            {{ Form::select('mes',$meses,Input::get('mes', $time->month), ['id' => 'mes', 'class' => 'form-control', 'required' => 'required']) }}
			            <small class="text-danger">{{ $errors->first('mes') }}</small>
			        </div>
			    </div>

			    <div class="form-group @if($errors->first('año')) has-error @endif">
			        {{ Form::label('año', 'Año:', ['class' => 'col-sm-3 control-label']) }}
			        <div class="col-sm-6">
			            {{ Form::number('año',Input::get('año', $time->year), ['class' => 'form-control', 'required' => 'required','min' => 1999 , 'max' => 2099]) }}
			            <small class="text-danger">{{ $errors->first('año') }}</small>
			        </div>
			    </div>

			    <div class="form-group @if($errors->first('concepto')) has-error @endif">
			        {{ Form::label('concepto', 'Concepto', ['class' => 'col-sm-3 control-label']) }}
			        <div class="col-sm-6">
			            {{ Form::text('concepto', null, ['class' => 'form-control', 'required' => 'required']) }}
			            <small class="text-danger">{{ $errors->first('concepto') }}</small>
			        </div>
			    </div>

			    <div class="form-group @if($errors->first('monto')) has-error @endif">
			        {{ Form::label('monto', 'Monto:', ['class' => 'col-sm-3 control-label']) }}
			        <div class="col-sm-6">
			            {{ Form::number('monto', null, ['class' => 'form-control', 'required' => 'required', 'step' => 0.001,  ])}}
			            <small class="text-danger">{{ $errors->first('monto') }}</small>
			        </div>
			    </div>

			    <div class="form-group @if($errors->first('residencia_id')) has-error @endif">
			        {{ Form::label('residencia_id', 'Residencias:', ['class' => 'col-sm-3 control-label']) }}
			        <div class="col-sm-6">
			            {{ Form::select('residencia_id[]',$residencias_opt, null, ['id' => 'residencia_id', 'class' => 'chosen-select form-control', 'required' => 'required', 'multiple','data-placeholder'=>"Selecciona las Resdencias"]) }}
			            <small class="text-danger">{{ $errors->first('residencia_id') }}</small>
			        </div>
			    </div>

			    <div class="form-group">
			        {{ Form::submit("Agregar Masivamente", ['class' => 'col-sm-offset-3 col-sm-6 btn btn-success']) }}
			    </div>
		    {{ Form::close() }}
     </div>

			<table class="table table-bordered table-hover text-center col-md-6">
			    <caption>Conceptos Asignados</caption>
			    <thead>
			        <tr>
			            <th>Concepto:</th>
			            <th>Monto:</th>
			            <th>Periodo:</th>
			            <th>Cantidad de Asignaciones:</th>
			            <th>Acción:</th>
			        </tr>
			    </thead>
			    <tbody>
			        @forelse ($conceptosmasivos as $element)
			        <tr>
			            <td>{{$element->concepto}}</td>
			            <td>{{ number_format($element->monto,2,",",".") }} {{ Config::get("var.moneda_abreviada") }} </td>
			            <td>{{$element->periodo}}</td>
			            <td>{{$element->cuenta}}</td>
			            <td><a class="btn btn-danger" href="{{url('admin/Finanzas/eliminarconceptomasivo'. '/' . $element->concepto)}}"> Eliminar Conceptos</a></td>
			        </tr>
			        @empty No Hay asignacciones @endforelse
			    </tbody>
			</table>

    <script>
        $(".chosen-select").chosen(
        {
            disable_search_threshold: 10,
            allow_single_deselect: true
        });
    </script>

     @include('admin.comun.cargadordeDeudas')
    @stop
