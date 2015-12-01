<?php	

class DirectivaTableSeeder extends Seeder {

	public function run()
	{
		$i=1;
		DB::table('Directiva')->delete();

		$directiva[] =(array("nombre" => "Fulano de Tal" , "Cargo" =>"Presidente de la junta Directiva","email"=> "fulano@residenciasonline.com","telefono" => "123456789"));
		$directiva[] =(array("nombre" => "Mengana" , "Cargo" =>"Secretario","email"=> "mengana@residenciasonline.com","telefono" => "123456789"));
		$directiva[] =(array("nombre" => "Pedro Pérez" , "Cargo" =>" Tesorero","email"=> "tesoro@residenciasonline.com","telefono" => "123456789"));
		$directiva[] =(array("nombre" => "Ana Rojas" , "Cargo" =>"Administrador","email"=> "Ana.rojas@residenciasonline.com","telefono" => "123456789"));
		$directiva[] =(array("nombre" => "Juan Gonzalez" , "Cargo" =>"Consejal","email"=> "JuanG@residenciasonline.com","telefono" => "123456789"));
		Directiva::insert($directiva);
		$this->command->info('Directiva Table Seed!');
		
	}

}