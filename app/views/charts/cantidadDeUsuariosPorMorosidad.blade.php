<?php 
$stocksTable = Lava::DataTable();
$stocksTable->addStringColumn('Cantidad de Usuarios')
->addNumberColumn('Cantidad');

$rowData = array('Al Día', Residencias::where('solvencia',"=" , 1)->count());
$stocksTable->addRow($rowData);
$rowData = array('Morosos', Residencias::where('solvencia',"=" , 0)->count());
$stocksTable->addRow($rowData);

$chart = Lava::PieChart('morosoChart')->title("Usuarios Morosos Vs Al Día")->colors(array('green','red'));  
$chart->datatable($stocksTable);

?>	
<h3 class="text-success text-center">Grafico de Usuarios Por Morosidad</h3>
{{Lava::  render('PieChart', 'morosoChart', 'morosoChart', array('width'=> 500, 'height' => 300));}}