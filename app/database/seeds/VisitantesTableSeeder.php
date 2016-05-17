<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VisitantesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create("es_VE");
		$visitantes = [];
		foreach(range(1, 100) as $index)
		{
			$visitantes[] = [
				"nombre" => $faker->name,
				"cedula" => rand(1000,10000000),
				"telefono" => rand(100000,10000000),
				"email" => $faker->email,
				"residencia_id" => rand(1,101)
			];
		}
		Visitante::insert($visitantes);
	}

}
