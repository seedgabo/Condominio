<?php 
$links = Residencias::paginate(15);
$residencias =  $links->lists('nombre','id');
		// dd($residencias);
$stocksTable = Lava::DataTable();
$stocksTable->addStringColumn('Cantidad de Personas')
->addNumberColumn('Cantidad',null,'#FFFFFF');

foreach ($residencias as $id => $residencia) 
{
	$rowData = array($residencia ,Residencias::find($id)->personas()->count());
	$stocksTable->addRow($rowData);
}

$chart = Lava::ColumnChart('CantidadChart')->title('Grafico de Habitat Por Residencia')->colors(array('yellow'));  
$chart->datatable($stocksTable);
?>

<div class="col-md-12">
	<h3 class="text-success text-center">Cantidad de Usuarios Por Residencia</h3>
	{{ Lava::  render('ColumnChart', 'CantidadChart', 'CantidadChart', true);}}

	<div class="col-md-9 col-md-offset-3">
		{{$links->links();}}
	</div>

</div>