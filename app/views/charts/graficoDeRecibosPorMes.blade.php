<?php 
$meses = getMeses();
$año = Input::get('año', $time->year );

$facturas = Facturas::groupby('mes')->select(DB::raw("mes ,año , sum(monto) as total"))
->where("año","=", $año)->get();
$stocksTable = Lava::DataTable();
$stocksTable->addStringColumn('Epoca')
->addNumberColumn('Total $');
foreach ($facturas as $factura)
{
	$label = $meses[$factura['mes']] . "/" . $factura["año"];
	$rowData = array($label, $factura['total']);
	$stocksTable->addRow($rowData);
}

$chart = Lava::AreaChart('FacturaChart')->title('Total de Monto de Recibo Por Mes')->colors(array('blue'));  
$chart->datatable($stocksTable);
?>	

<h3 class="text-success text-center">Grafico de Facturas Por Mes</h3>
{{ Lava::  render('AreaChart', 'FacturaChart', 'FacturaChart', true) }}
{{ Form::open(['method' => 'GET' , 'class' => 'form-inline']) }}
<div class="col-md-4 col-md-offset-4">
	{{ Form::number('año', $año, ['class'=>'form-control', 'min'=>'1999','max'=>'2099']) }}
	{{ Form::submit("Ver", ['class' => 'btn btn-primary']) }}
</div>
{{ Form::close() }}
