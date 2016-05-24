<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DocumentosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$documentos = [];

		$documentos[] =[
			"titulo"  => "Carta de Residencia" , "contenido" => '<div style="background-color:rgb(230, 230, 255); padding:10px;"> <h2 style="text-align:right"><img alt="" src="http://localhost/condominio/images/condominio/logo.png" style="float:left" /><span style="font-size:20px">{condo}</span></h2> <p style="text-align:right"><span style="font-size:16px">{condo_direccion}</span></p> <p style="text-align:right"><span style="font-size:12px">Rif:&nbsp;{condo_doc}</span></p> </div> <p style="text-align:right"><span style="color:#0000FF"><span style="font-size:14px">{fecha}</span></span></p> <p style="text-align:center">&nbsp;</p> <p style="text-align:center"><span style="color:#000000"><span style="font-size:18px">CARTA DE RESIDENCIA</span></span></p> <p style="text-align:center">&nbsp;</p> <p style="text-align:center">&nbsp;</p> <p style="text-align:center">&nbsp;</p> <p style="text-align:justify"><span style="font-size:18px">Por medio de la presente hacemos constar &nbsp;actuando como Miembros &nbsp;Legales de este consejo Comunal y vecinos de&nbsp;{condo}, que el ciudadano&nbsp;{persona} portador(a) de la cedula de identidad N&ordm;&nbsp;{persona_cedula} , reside en este sector en la&nbsp;{residencia}.</span></p> <p style="text-align:justify"><span style="font-size:18px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Documento Expedido a los&nbsp;{dia} d&iacute;a(s)&nbsp;del mes de&nbsp;{nombre_mes} de&nbsp;{ano}</span></p> <p style="text-align:justify"><span style="font-size:18px">&nbsp; &nbsp; &nbsp; Dicho Ciudadano(a) presenta buena conducta y espiritu de colaboraci&oacute;n por los dem&aacute;s</span></p> <p style="text-align:justify">&nbsp;</p> <p style="text-align:right"><span style="font-size:18px">&nbsp; &nbsp; &nbsp; &nbsp;</span><strong><em><span style="font-size:20px">Atentamente, El consejo comunal de&nbsp;{condo}</span></em></strong></p> <p style="text-align:right">&nbsp;</p> <p style="text-align:right">&nbsp;</p> <p style="text-align:right">&nbsp;</p> <p style="text-align:right">&nbsp;</p> <p style="text-align:right">&nbsp;</p> <p style="text-align:right">&nbsp;</p> <p style="text-align:center">__________________________________</p> <p style="text-align:center"><strong><span style="font-size:22px">{propietario}</span></strong></p> <p style="text-align:center"><span style="font-size:20px"><strong>C.I</strong>:&nbsp;{propietario_cedula}</span></p> <p style="text-align:center"><span style="font-size:20px"><strong>Telefono</strong>: {propietario_telefono}</span></p> <p style="text-align:center">&nbsp;</p> <p><img alt="" src="http://localhost/condominio/images/condominio/logo.png" style="float:right; height:70px; width:130px" />Telefono:&nbsp;{condo_telefono}</p> <p>Correo:&nbsp;{condo_email}</p> <p style="text-align:left">Rif: {condo_doc}</p> '
		];
		Documento::insert($documentos);
	}

}
