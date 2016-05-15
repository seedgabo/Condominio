<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
class VehiculosTableSeeder extends Seeder {

	public function run()
	{
		$carros = ["Ford Fiesta", "Camaro" ,"Aveo" ,"Renault Logan", "Meru", "Moto R2","Spark","Mazda 3", "Mustang GT","Mitsubishi Lancer"];
		$faker = Faker::create('es_VE');
		$vehiculos = [];
		foreach(range(1, 150) as $index)
		{
			$vehiculos[]= [
				'nombre' => $carros[rand(0,count($carros)-1)],
				'color'  => $faker->safeColorName,
				'placa' =>  $faker->text(7),
				'residencia_id' => rand(1,101)
			];
		}
		Vehiculo::insert($vehiculos);
	}

}
