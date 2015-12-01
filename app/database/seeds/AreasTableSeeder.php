<?php	

class AreasTableSeeder extends Seeder {

	public function run()
	{
		$i=1;
		DB::table('areas')->delete();

		$areas[] =(array('id'=> ''.$i++, 'nombre' => 'piscina', 'descripcion' => 'Capacidad: 20 personas Horario: 8am- 9pm'));
		$areas[] =(array('id'=> ''.$i++, 'nombre' => 'Areas Verdes', 'descripcion' => 'Terreno: 200 mts2'));
		$areas[] =(array('id'=> ''.$i++, 'nombre' => 'Salon de Fiesta', 'descripcion' => 'Capacidad: 100 personas, Utileria: 40 sillas y 8 mesas'));
		$areas[] =(array('id'=> ''.$i++, 'nombre' => 'Caney', 'descripcion' => 'Alquilable'));
		$areas[] =(array('id'=> ''.$i++, 'nombre' => 'Caney Secundario', 'descripcion' => 'Recreación para propietarios'));
		$areas[] =(array('id'=> ''.$i++, 'nombre' => 'Entrada Y Vigilancia', 'descripcion' => 'Empresas de Seguridad: SeguroCondominio'));
		Areas::insert($areas);
		$this->command->info('Areas Table Seed!');
	}

}