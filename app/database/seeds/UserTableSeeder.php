<?php	

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('personas')->delete();
		$contraseña =Hash::make('abcdef') ;
		$faker = Faker\Factory::create('es_VE');
		User::create(array('nombre' => 'Gabriel Bejarano' , 'email' => 'seedgabo@gmail.com', 'password' => Hash::make('gab23gab') , 'residencia_id' =>'2', 'admin' => '1'));
		for ($i=0; $i <200 ; $i++)
		{ 
			User::create(array('nombre' => $faker->name , 'email' =>  $faker->email, 'password' => $contraseña, 'residencia_id' => rand(1,100), 'admin' => '0'));
		}
		$this->command->info('Personas Table Seed!');
	}
}