<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DocumentosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$documentos = [];
		foreach(range(1, 10) as $index)
		{
			$documentos[] =[
				"titulo"  => $faker->word , "contenido" => $faker->text
			];
		}
		Documento::insert($documentos);
	}

}
