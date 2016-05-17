
<?php
$propietario = $residencia->propietario ? $residencia->propietario : (new User);
$tiempo =  new Carbon();
$busqueda = array( "{residencia}", "{residencia_alicuota}", "{residencia_solvencia}", "{residencia_qtyper}", "{residencia_telefono}", "{persona}", "{persona_email}", "{persona_telefono}", "{persona_cedula}", "{persona_imagen}", "{propietario}", "{propietario_email}", "{propietario_telefono}", "{propietario_cedula}", "{propietario_imagen}", "{condo}", "{condo_direccion}", "{condo_telefono}", "{condo_email}", "{condo_cuenta}", "{condo_keycode}", "{condo_long}", "{condo_lat}", "{moneda}", "{moneda_abreviada}", "{pais}", "{dia}", "{mes}", "{ano}", "{hora}", "{minuto}", "{segundo}", "{nombre_dia}", "{fecha}", );

$reemplazo= array( $residencia->nombre, $residencia->alicuota, $residencia->solvencia ==1 ? 'Al Día' : 'Moroso', $residencia->cant_personas, $residencia->telefono, $persona->nombre, $persona->email, $persona->telefono, number_format($persona->cedula,0,",","."), "<p><img style=&quot;float:left&quot; src=&quot;{{$persona->avatar}}&quot;/></p>", $propietario->nombre, $propietario->email, $propietario->telefono, number_format($propietario->cedula,0,",","."), "<p><img style=&quot;float:left&quot; src=&quot;{{$propietario->avatar}}&quot;/></p>", Config::get("var.nombre", ""), Config::get("var.ubicacion", ""), Config::Get("var.telefono",""), Config::get("var.email", ""), Config::get("var.cuenta-bancaria", ""), Config::get("var.keycode", ""), Config::get("var.long", ""), Config::get("var.lat", ""), Config::get("var.moneda", ""), Config::get("var.moneda_abreviada", ""), Config::get("var.pais", ""), $tiempo->day, $tiempo->month, $tiempo->year, $tiempo->hour, $tiempo->minute, $tiempo->second, traducir_fecha($tiempo->dayOfWeek), traducir_fecha($tiempo->formatLocalized('%a %d %b %y')), );

$contenido = str_ireplace($busqueda,$reemplazo,$contenido);
?>
{{ $contenido }}
<br>

{{Config::get('var.nombre')}}
