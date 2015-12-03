<?php
function quitar_tildes($cadena) 
{
	$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
	$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
	$texto = str_replace($no_permitidas, $permitidas ,$cadena);
	return $texto;
}

function traducir_fecha($cadena, $diferencia = false)
{
	$recibido = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Mon','Tue','Wed','Thu','Fri','Sat','Sun','January','February','March','April','May','June','July','August','September','October','November','December','second','seconds','minute','minutes','day','days','hour','hours','month','months','year','years','week','weeks','before','after');
	$traducido = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Lun','Mar','Mie','Jue','Vie','Sab','Dom','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre','Segundo','Segundos','Minuto','Minutos','Dia','Dias','Hora','Horas','Mes','Meses','Año','Años','Semana','Semanas','Antes','Despues');
	$texto = str_replace($recibido,$traducido,$cadena);
	if (ends_with($texto,"Antes"))
	{
		$texto = "Dentro de " .str_replace("Antes","",$texto); 
	}
	if (ends_with($texto,"Despues"))
	{
		$texto = "Hace " .str_replace("Despues","",$texto); 
	}

	if($diferencia == true)
	{
		$texto = str_replace(["Dentro de ", "Hace "],"",$texto); 
	}

	return $texto;
}

function revisar_expansion ($opcion)
{
	if ((Request::segment(2) == $opcion))
		return "collapse in";
	else if (($opcion  == "Admin") && (Request::segment(2)!= "Email") && (Request::segment(2)!= "Dise%C3%B1o") && (Request::segment(2)!= "Finanzas") )
		return "collapse in";
	else
		return "collapse";
}

function getMeses()
{
	return array("Meses","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
}

function sendFacturaMail()
{
		Mail::send('pdf.factura',array('mes' => $mes, 'año' => $año, 'factura' => $factura, 'cant_residencias' => $cant_residencias,'persona'=> $persona,'residencia' => $residencia),function($message)
		{
				 $message->from('Gabriel@residenciasOnline.com', 'Tu Residencia');
    		 $message->to('seedgabo@gmail.com');
		});
}

// Funciones para obtener rutas a directorios Publicos
function condominio_path($file = null)
{
	return public_path() . "/images/condominio/" . $file;
}
function galeria_path($file = null)
{
	return public_path() . "/images/galeria/" . $file;
}
function noticias_path($file = null)
{
	return public_path() . "/images/noticias/" . $file;
}
function portadas_path($file = null)
{
	return public_path() . "/images/portadas/" . $file;
}
function recibos_path($file = null)
{
	return public_path() . "/images/recibos/" . $file;
}

?>
