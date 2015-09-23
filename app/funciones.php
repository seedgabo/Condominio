<?php
function quitar_tildes($cadena) 
{
	$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
	$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
	$texto = str_replace($no_permitidas, $permitidas ,$cadena);
	return $texto;
}

function traducir_fecha($cadena)
{
	$recibido = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','January','February','March','April','May','June','July','August','September','October','November','December');
	$traducido = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	$texto = str_replace($recibido,$traducido,$cadena);
	return $texto;
}
	
?>