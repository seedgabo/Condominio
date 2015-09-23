<?php	

class DirectivaTableSeeder extends Seeder {

	public function run()
	{
		$i=1;
		DB::table('Directiva')->delete();

		Directiva::create(array("nombre" => "Fulano de Tal" , "Cargo" =>"Presidente de la junta Directiva"));
		Directiva::create(array("nombre" => "Mengana" , "Cargo" =>"Secretario"));
		Directiva::create(array("nombre" => "Pedro Pérez" , "Cargo" =>" Tesorero"));
		Directiva::create(array("nombre" => "Ana Rojas" , "Cargo" =>"Administrador"));
		Directiva::create(array("nombre" => "Juan Gonzalez" , "Cargo" =>"Consejal"));
		 $this->command->info('Directiva Table Seed!');
		
	}

}