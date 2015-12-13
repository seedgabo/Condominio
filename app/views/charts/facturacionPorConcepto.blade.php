<?php 
$mes = Input::get('mes', $time->month);
$año = Input::get('año', $time->year );
$conceptos = Facturas::where('mes','=',$mes)->where('año','=',$año)->wherenull("residencia_id")->select('concepto','monto')
->orderby('monto','asc')->get();

$stocksTable = Lava::DataTable();
$stocksTable->addStringColumn('Concepto')
->addNumberColumn("Monto $")
->addNumberColumn("SubTotal $");
$subtotal = 0;
$rowData = array('Monto X Concepto');
foreach ($conceptos as $concepto) 
{
	$rowData = array($concepto['concepto'] ,
	$concepto['monto'], $subtotal+= $concepto['monto']);
	$stocksTable->addRow($rowData);
}

$chart = Lava::ComboChart('conceptoChart')->series(array(0 => Lava::Series(array('type' => 'bars'))))->title("Monto X Concepto");
$chart->datatable($stocksTable);

?>	
<h3 class="text-success text-center">Grafico de Usuarios Por Morosidad</h3>
{{Lava::  render('ComboChart', 'conceptoChart', 'conceptoChart', array('width'=> 500, 'height' => 300));}}

{{ Form::open(['method' => 'GET' , 'class' => 'form-inline']) }}
<div class="col-md-12">
	{{Form::select('mes', getMeses(), $mes, ['class' => 'form-control'])}}
	{{ Form::number('año', $año, ['class'=>'form-control', 'min'=>'1999','max'=>'2099']) }}
	{{ Form::submit("Ver", ['class' => 'btn btn-primary']) }}
</div>
{{ Form::close() }}
