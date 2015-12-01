<?php	

class PersonalTableSeeder extends Seeder {
	public function run()
	{
		$trabajos =  array("Limpieza","albañil","plomero","constructor","Domestico","Electricidad","Niñero","Seguridad");
		DB::table('personal')->delete();
		$faker = Faker\Factory::create('es_VE');
		
		for ($i=0; $i <70 ; $i++) 
		{ 
			$personal[] = (array('nombre'=> $faker->name,'cedula'=> $faker->numberBetween(10000000,20000000),'email' => $faker->email, 'cargo' => $trabajos[rand(0,7)], 'telefono' => $faker->phoneNumber, 'residencia_id' => rand(1,101)));
		}
		Personal::insert($personal);
	 $this->command->info('Personal Table Seed!');
	}

}