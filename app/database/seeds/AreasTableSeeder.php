<?php	

class AreasTableSeeder extends Seeder {

	public function run()
	{
		$i=1;
		DB::table('areas')->delete();

		Areas::create(array('id'=> ''.$i++, 'nombre' => 'piscina', 'descripcion' => 'Capacidad: 20 personas Horario: 8am- 9pm'));
		Areas::create(array('id'=> ''.$i++, 'nombre' => 'Areas Verdes', 'descripcion' => 'Terreno: 200 mts2'));
		Areas::create(array('id'=> ''.$i++, 'nombre' => 'Salon de Fiesta', 'descripcion' => 'Capacidad: 100 personas, Utileria: 40 sillas y 8 mesas'));
		Areas::create(array('id'=> ''.$i++, 'nombre' => 'Caney', 'descripcion' => 'Alquilable'));
		Areas::create(array('id'=> ''.$i++, 'nombre' => 'Caney Secundario', 'descripcion' => 'Recreación para propietarios'));
		Areas::create(array('id'=> ''.$i++, 'nombre' => 'Entrada Y Vigilancia', 'descripcion' => 'Empresas de Seguridad: SeguroCondominio'));
		$this->command->info('Areas Table Seed!');
	}

}