<?php $sum = 0; ?>
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
    <table class="table" style="background-color: #EEEEFF">
        <thead>
            <tr>
                <td><img src="{{asset('images/condominio/logo.png')}}" alt=""></td>
                <td style="text-align: right; vertical-align: middle;">
                    <strong>Comprobante #: </strong> {{$mes . $año. $residencia->id}}
                    <br><strong>Creado el: </strong>  {{traducir_fecha($time->formatLocalized('%a %d %b %y'))}}
                    <br><strong>Del: </strong>  {{traducir_fecha(Carbon::parse($año ."/".$mes."/01")->formatLocalized('%a %d %b %y'))}}
                </td>
            </tr>
        </thead>
    </table>

    <table class="table" style=" text-transform: uppercase;">
        <div style="text-align: center !important;">
            <a href="{{url()}}">{{Config::get('var.nombre')}}</a>
        </div>
        <thead>
            <tr>
                <td>{{Config::get('var.ubicacion')}}</td>
                <td style="text-align: right; vertical-align: middle;">
                    {{$residencia->nombre}}<br>
                    {{$persona->nombre}}  <br>
                    {{$persona->email}}
                </td>
            </tr>
        </thead>
    </table>

    <div style="border-top: 1px solid #CABCEA;"></div> <br>
    <br>
        <h2 style="text-align:center">Comprobante de Solvencia {{traducir_fecha(Carbon::parse($año ."/".$mes."/01")->formatLocalized(' %B %Y'))}}</h2>
        <br>
    <p style="text-align:justify; font-size:18px;">
        &nbsp; &nbsp; Se hace constar que  {{$persona->nombre}},
        {{ trans('literales.DNI') }} {{$persona->cedula}} propietario de {{$residencia->nombre}},
        aparece en los libros de  {{Config::get("var.nombre")}} "{{$solvencia->estado}}" al cierre del mes de {{traducir_fecha(Carbon::parse($año ."/".$mes."/01")->formatLocalized(' %B de  %Y'))}}
        <br><br> <br>
        <span style="text-align:right"> Solvencia que se expide a solicitud de la parte interesada a los {dia} días del mes de {nombre_mes} de {ano}.</span>
    </p>
    <p style="text-align:right"><span style="font-size:18px">&nbsp; &nbsp; &nbsp; &nbsp;</span><strong><em><span style="font-size:20px">Atentamente, El consejo comunal de&nbsp;{condo}</span></em></strong></p>

<br><br><br><br><br><br>
<p style="text-align:center">__________________________________</p>

<p style="text-align:center"><strong><span style="font-size:22px">{propietario}</span></strong></p>

<p style="text-align:center"><span style="font-size:20px"><strong>C.I</strong>:&nbsp;{propietario_cedula}</span></p>

<p style="text-align:center"><span style="font-size:20px"><strong>Telefono</strong>: {propietario_telefono}</span></p>

<p style="text-align:center">&nbsp;</p>

<p><img alt="" src="http://localhost/condominio/images/condominio/logo.png" style="float:right; height:70px; width:130px" />Telefono:&nbsp;{condo_telefono}</p>

<p>Correo:&nbsp;{condo_email}</p>

<p style="text-align:left">Rif: {condo_doc}</p>
