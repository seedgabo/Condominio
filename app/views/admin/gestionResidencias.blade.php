<?php
$año = Input::get('año', $time->year);
$estados  = array ('0' => 'No Activo', '1' => "Al Día", '2' => 'Crédito', '3' => 'Moroso');
?>
@extends('admin/layout')
@section('content')
	<div class="col-md-12">
		<form method="GET" class="form-inline" role="form">

			<div class="form-group">
				<input type="search" class="form-control" name="residencia" placeholder="Buscar...">
				<input type="number" class="form-control" name="año" value="{{$año}}">
				Mostrar: <select name="per_page" class="form-control" id="">
					<option value="12" {{Input::get('per_page') == 12? 'selected' : ''}}>12</option>
					<option value="25" {{Input::get('per_page') == 25? 'selected' : ''}}>25</option>
					<option value="50" {{Input::get('per_page') == 50? 'selected' : ''}}>50</option>
					<option value="100" {{Input::get('per_page') == 100? 'selected' : ''}}>100</option>
					<option value="1000" {{Input::get('per_page') == 1000? 'selected' : ''}}>1000</option>
				</select>
			</div>

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
		</form>

		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					@foreach (getMeses() as $mes)
						<th>@if($mes!= 'Meses') {{$mes}} @else {{'Año: '. $año}} @endif</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@forelse ($residencias as $residencia)
						<tr>
							<td ondblclick="$('#ver-residencia').modal('show')">{{$residencia->nombre}}</td>
							@for ($mes = 1; $mes <=12 ; $mes++)
								<td id="{{$año."-".$mes."-".$residencia->id}}">
									@include('admin/estadoSolvencia',compact('año','residencia','mes'))
								</td>
							@endfor
						</tr>
					@empty
						No Hay Residencias
					@endforelse
				</tbody>
			</table>
		</div>


		{{$residencias->appends(array('per_page' => Input::get('per_page', 12), 'año' => Input::get('año'), 'residencia' => Input::get('residencia')))->links() }}


		<div class="modal fade" id="ver-solvencia">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Editar Pagos</h4>
					</div>
					<div class="modal-body" id="ver">
						{{ Form::open(['method' => 'POST', 'url' => 'ajax/solvencias/', 'class' => 'form-horizontal', 'name' => 'solvencia']) }}
						<input type="hidden" name="id" value="">
						<div class="form-group @if($errors->first('mes')) has-error @endif">
							{{ Form::label('mes', 'Mes:', ['class' => 'col-sm-3 control-label']) }}
							<div class="col-sm-9">
								{{ Form::select('mes',getMeses(), null, ['id' => 'mes', 'class' => 'form-control', 'required' => 'required', 'disabled']) }}
								<small class="text-danger">{{ $errors->first('mes') }}</small>
							</div>
						</div>

						<div class="form-group @if($errors->first('año')) has-error @endif">
							{{ Form::label('año', 'Año', ['class' => 'col-sm-3 control-label']) }}
							<div class="col-sm-9">
								{{ Form::selectYear('año', date('Y')-10, date('Y') + 10, $año, ['class' => 'form-control', 'required' => 'required', 'disabled']) }}
								<small class="text-danger">{{ $errors->first('año') }}</small>
							</div>
						</div>

						<div class="form-group @if($errors->first('monto')) has-error @endif">
							{{ Form::label('monto', 'Monto:', ['class' => 'col-sm-3 control-label']) }}
							<div class="col-sm-9">
								{{ Form::number('monto', null, ['class' => 'form-control', 'required' => 'required']) }}
								<small class="text-danger">{{ $errors->first('monto') }}</small>
							</div>
						</div>

						<div class="form-group @if($errors->first('estado')) has-error @endif">
							{{ Form::label('estado', 'Estado', ['class' => 'col-sm-3 control-label']) }}
							<div class="col-sm-9">
								{{ Form::select('estado',$estados, null, ['id' => 'estado', 'class' => 'form-control', 'required' => 'required']) }}
								<small class="text-danger">{{ $errors->first('estado') }}</small>
							</div>
						</div>

						<div class="form-group @if($errors->first('cancelado_el')) has-error @endif">
							{{ Form::label('cancelado_el', 'Cancelado el:', ['class' => 'col-sm-3 control-label']) }}
							<div class="col-sm-9">
								<input type="date" name="cancelado_el" value="{{$time->format('Y-m-d')}}" placeholder="">
								<small class="text-danger">{{ $errors->first('cancelado_el') }}</small>
							</div>
						</div>

						<div class="form-group @if($errors->first('facturado_el')) has-error @endif">
							{{ Form::label('facturado_el', 'Facturado el:', ['class' => 'col-sm-3 control-label']) }}
							<div class="col-sm-9">
								<input type="date" name="facturado_el" value="{{$time->format('Y-m-d')}}" placeholder="">
								<small class="text-danger">{{ $errors->first('facturado_el') }}</small>
							</div>
						</div>
						{{ Form::close() }}
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="button" onclick="establecer()" class="btn btn-primary">Guardar Cambios</button>
					</div>
				</div>
			</div>
		</div>

		<script>
		function pagar(residencia_id,mes,año,element)
		{
			$.post('{{url("ajax/solvencias/solventar")}}',
			{
				'residencia_id': residencia_id,
				'mes': mes,
				'año': año
			}
			, function(response)
			{
				$("#"+año+"-"+mes+"-"+residencia_id).html(response);
			});
		}

		function adeudar(residencia_id,mes,año)
		{
			$.post('{{url("ajax/solvencias/adeudar")}}',
			{
				'residencia_id': residencia_id,
				'mes': mes,
				'año': año
			}
			, function(response)
			{
				$("#"+año+"-"+mes+"-"+residencia_id).html(response);
			});
		}
		function acreditar(residencia_id,mes,año)
		{
			$.post('{{url("ajax/solvencias/acreditar")}}',
			{
				'residencia_id': residencia_id,
				'mes': mes,
				'año': año
			}
			, function(response)
			{
				$("#"+año+"-"+mes+"-"+residencia_id).html(response);
			});
		}
		function desactivar(residencia_id,mes,año)
		{
			$.post('{{url("ajax/solvencias/desactivar")}}',
			{
				'residencia_id': residencia_id,
				'mes': mes,
				'año': año
			}
			, function(response)
			{
				$("#"+año+"-"+mes+"-"+residencia_id).html(response);
			});
		}
		function obtener(residencia_id,mes,año)
		{
			$.get('{{url("ajax/solvencias/obtener")}}',
			{
				'residencia_id': residencia_id,
				'mes': mes,
				'año': año
			}
			, function(response)
			{
				$("[name='id']").val(response.id);
				$("[name='mes']").val(response.mes);
				$("[name='monto']").val(response.monto);
				$("[name='estado']").val(response.estado_org);
				$("#ver-solvencia").modal("show");
			});
		}
		function establecer()
		{
			$.post('{{url("ajax/solvencias/establecer")}}',

			$("form[name='solvencia'").serialize()
			, function(response)
			{
				$('#ver-solvencia').modal('hide');
				vistar(response.id, '#'+ response.año+"-"+response.mes+"-"+response.residencia_id);
			});
		}
		function vistar(data_id,element_id)
		{
			$.get('{{url("ajax/solvencias/vistar")}}',
			{
				'id': data_id
			}
			, function(response)
			{
				$(element_id).html(response);
			});
		}
		</script>
@stop
