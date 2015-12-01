<?php	

class NoticiasTableSeeder extends Seeder {

	public function run()
	{
		$fecha =Carbon\Carbon::now();
		DB::table('noticias')->delete();
		Noticias::create(array('titulo' => 'Bienvenidos', 'contenido' => 'Tenemos el agrado de presentarte tu nuevo sistema web de control e información de condominios <br> Echa Un vistazo a traves de las opciones presentadas, ven uestros videos demostrativos o lee nuestro manual del usuario' ,'persona' => 'Sistema', 'fecha'=> $fecha ));
		Noticias::create(array('titulo' => 'Informacion', 'contenido' => 'Puedes agregar tus propias noticias para compartirlas con el resto de los usuarios, aprovecha y promociona tus productos, o comparte imagenes de tus juntas de condominio, Se precavido' ,'persona' => 'Sistema', 'fecha'=> $fecha));

		DB::table('eventos')->delete();
		Eventos::create(array('razon'=>'Junta de Condominio','fecha_ini' => $fecha, 'fecha_fin'=> $fecha, 'tiempo_ini' => $fecha->format('H:i:s') , 'tiempo_fin'=>$fecha->addHours(2)->format('H:i:s') ));
	 	
	 	
	 	db::Table('portadas')->delete();
	 	db::Table('portadas')->insert(array("id"=>1 ,"titulo" => "Mi Residencia esta la WEB!!","media" => "slider1.jpg" , "contenido" => "ResidenciasOnline.com"));
	 $this->command->info('Noticias Table Seed!');
	}

}
