@extends('admin/layout')
@section('content')
<br>
<div class="">
	
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