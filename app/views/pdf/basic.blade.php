<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{asset('css/bootstrap-email.css')}}">
    <!-- Latest compiled and minified CSS & JS -->
    <style type="text/css" media="screen">
        body
        {
            font-family: 'Helvetica Neue';
            font-size: 14px;
            font-weight: 12px;
        }
    </style>
</head>

<body>
<?php
$propietario = $residencia->propietario ? $residencia->propietario : (new User);
$tiempo =  new Carbon();
$busqueda = array( "{residencia}", "{residencia_alicuota}", "{residencia_solvencia}", "{residencia_qtyper}", "{residencia_telefono}", "{persona}", "{persona_email}", "{persona_telefono}", "{persona_cedula}", "{persona_imagen}", "{propietario}", "{propietario_email}", "{propietario_telefono}", "{propietario_cedula}", "{propietario_imagen}", "{condo}", "{condo_direccion}", "{condo_telefono}", "{condo_email}", "{condo_cuenta}","{condo_doc}" ,"{condo_keycode}", "{condo_long}", "{condo_lat}", "{moneda}", "{moneda_abreviada}", "{pais}", "{dia}", "{mes}", "{ano}", "{hora}", "{minuto}", "{segundo}", "{nombre_dia}", "{nombre_mes}" , "{fecha}", );

$reemplazo= array( $residencia->nombre, $residencia->alicuota, $residencia->solvencia ==1 ? 'Al Día' : 'Moroso', $residencia->cant_personas, $residencia->telefono, $persona->nombre, $persona->email, $persona->telefono, number_format($persona->cedula,0,",","."), "<p><img style=&quot;float:left&quot; src=&quot;{{$persona->avatar}}&quot;/></p>", $propietario->nombre, $propietario->email, $propietario->telefono, number_format($propietario->cedula,0,",","."), "<p><img style=&quot;float:left&quot; src=&quot;{{$propietario->avatar}}&quot;/></p>", Config::get("var.nombre", ""), Config::get("var.ubicacion", ""), Config::get("var.telefono",""), Config::get("var.email", ""), Config::get("var.cuenta-bancaria", ""), Config::get("var.documento", ""), Config::get("var.keycode", ""), Config::get("var.long", ""), Config::get("var.lat", ""), Config::get("var.moneda", ""), Config::get("var.moneda_abreviada", ""), Config::get("var.pais", ""), $tiempo->day, $tiempo->month, $tiempo->year, $tiempo->hour, $tiempo->minute, $tiempo->second, traducir_fecha($tiempo->formatLocalized('%A ')),traducir_fecha($tiempo->formatLocalized('%b ')), traducir_fecha($tiempo->formatLocalized('%A,  %d de %b de %Y')), );

$contenido = str_replace($busqueda,$reemplazo,$contenido);
?>
{{ str_replace("<p>&nbsp;</p>","<br>",$contenido) }}
<br>

</body>
</html>
