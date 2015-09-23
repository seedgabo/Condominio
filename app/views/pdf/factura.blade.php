<?php $total =0; ?>
<html>

<head>
	<title>Documento sin t&iacute;tulo</title>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<style type="text/css">
		ol {
			margin: 0;
			padding: 0
		}
		
		.c4 {
			border-right-style: solid;
			padding: 5pt 5pt 5pt 5pt;
			border-bottom-color: #000000;
			border-top-width: 1pt;
			border-right-width: 1pt;
			border-left-color: #000000;
			vertical-align: top;
			border-right-color: #000000;
			border-left-width: 1pt;
			border-top-style: solid;
			border-left-style: solid;
			border-bottom-width: 1pt;
			width: 206.8pt;
			border-top-color: #000000;
			border-bottom-style: solid;
			text-align: right;
		}
		
		.c3 {
			color: #000000;
			font-weight: normal;
			text-decoration: none;
			vertical-align: baseline;
			font-size: 12pt;
			font-family: "Arial";
			font-style: normal
		}
		
		.c0 {
			padding-top: 0pt;
			padding-bottom: 0pt;
			line-height: 1.0;
			text-align: center;
			direction: ltr
		}
		
		.c6 {
			orphans: 2;
			widows: 2;
			text-align: center;
			direction: ltr
		}
		
		.c7 {
			page-break-after: avoid;
			orphans: 2;
			widows: 2;
			direction: ltr
		}
		
		.c8 {
			orphans: 2;
			widows: 2;
			direction: ltr
		}
		
		.c2 {
			border-collapse: collapse;
			align: center !important;
			text-align: center !important;
		}
		
		.c11 {
			background-color: #ffffff;
			max-width: 413.6pt;
			padding: 113.4pt 85pt 85pt 113.4pt
		}
		
		.c5 {
			height: 11pt
		}
		
		.c10 {
			font-size: 12pt
		}
		
		.c9 {
			page-break-after: avoid
		}
		
		.c1 {
			height: 0pt
		}
		
		.title {
			padding-top: 0pt;
			color: #000000;
			font-size: 21pt;
			padding-bottom: 0pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			orphans: 2;
			widows: 2;
			text-align: left
		}
		
		.subtitle {
			padding-top: 0pt;
			color: #666666;
			font-size: 13pt;
			padding-bottom: 10pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			font-style: italic;
			orphans: 2;
			widows: 2;
			text-align: left
		}
		
		li {
			color: #000000;
			font-size: 11pt;
			font-family: "Arial"
		}
		
		p {
			margin: 0;
			color: #000000;
			font-size: 11pt;
			font-family: "Arial"
		}
		
		h1 {
			padding-top: 10pt;
			color: #000000;
			font-size: 16pt;
			padding-bottom: 0pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			orphans: 2;
			widows: 2;
			text-align: left
		}
		
		h2 {
			padding-top: 10pt;
			color: #000000;
			font-weight: bold;
			font-size: 13pt;
			padding-bottom: 0pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			orphans: 2;
			widows: 2;
			text-align: left
		}
		
		h3 {
			padding-top: 8pt;
			color: #666666;
			font-weight: bold;
			font-size: 12pt;
			padding-bottom: 0pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			orphans: 2;
			widows: 2;
			text-align: left
		}
		
		h4 {
			padding-top: 8pt;
			color: #666666;
			text-decoration: underline;
			font-size: 11pt;
			padding-bottom: 0pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			orphans: 2;
			widows: 2;
			text-align: left
		}
		
		h5 {
			padding-top: 8pt;
			color: #666666;
			font-size: 11pt;
			padding-bottom: 0pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			orphans: 2;
			widows: 2;
			text-align: left
		}
		
		h6 {
			padding-top: 8pt;
			color: #666666;
			font-size: 11pt;
			padding-bottom: 0pt;
			font-family: "Trebuchet MS";
			line-height: 1.15;
			page-break-after: avoid;
			font-style: italic;
			orphans: 2;
			widows: 2;
			text-align: left
		}
	</style>
</head>

<body class="">
<div align="center">
		<img  src="images/condominio/logo.png" width="100" alt="">
	</div>

	<p style="text-align: center" class="c6 c9 title">
		{{Config::get('var.condominio')}} 
		<br>	<span>RECIBO</span>
	</p>
	<p class="c7 subtitle">
		<br>Cliente: {{$persona->nombre}}
		<br>Residencia: {{$residencia->nombre}}
		<br> Fecha: {{$time}}
		<br> Alicuota: {{$residencia->alicuota}} %
	</p>
	<p class="c6">
		<span class="c10">Mes: {{$time->month}} del &nbsp;A&ntilde;o {{$time->year}}
		</span> </p>
		<table cellpadding="0" cellspacing="0" class="c2">
			<tbody>
				<tr class="c1">
					<td class="c4" colspan="1" rowspan="1">
						<p class="c0"><span class="c3">CONCEPTO</span></p>
					</td>
					<td class="c4" colspan="1" rowspan="1">
						<p class="c0"><span class="c3">&nbsp;MONTO</span></p>
					</td>
				</tr>
				@foreach ($factura as $element)
				<tr class="c1">
					<td style="text-align: center" class="c4">{{$element->concepto}}</td>
					<td class="c4">{{Config::get('var.moneda_abreviada')}} {{number_format($element->monto,2,",",".")}} </td>
				</tr>
				<?php $total = $total + $element->monto ?>
				@endforeach
				<tr>
					<td style="text-align: right"> {{"Total: ". number_format($total,2,",",".") }} {{Config::get('var.moneda')}}</td>
					<td style="text-align: right">{{"Fraccion: ".number_format($total* $residencia->alicuota/100,2,",",".")}} {{Config::get('var.moneda')}}</td>
				</tr>
			</tbody>
		</table>
	</body>

	</html>
