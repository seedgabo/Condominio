<?php	

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('personas')->delete();
		$contraseña =Hash::make('abcdef') ;
		$faker = Faker\Factory::create('es_VE');
		User::create(array('nombre' => 'Gabriel Bejarano' , 'email' => 'seedgabo@gmail.com', 'password' => Hash::make('gab23gab') , 'residencia_id' =>'2', 'admin' => '1'));
		User::create(array('nombre' => 'Usuario de Prueba' , 'email' => 'sistema@residenciasonline.com', 'password' => Hash::make('residenciasonline') , 'residencia_id' =>'1', 'admin' => '1', 'avatar' => 'https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif'));
		for ($i=0; $i <200 ; $i++)
		{ 
			$users[]= array('nombre' => $faker->name , 'email' =>  $faker->email, 'password' => $contraseña, 'residencia_id' => rand(1,100), 'admin' => '0');
		}
			User::insert($users);

		$this->command->info('Personas Table Seed!');
	}
}