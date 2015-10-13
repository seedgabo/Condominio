<?php	

class ResidenciasTableSeeder extends Seeder {

	public function run()
	{
		DB::table('residencias')->delete();
		Residencias::create(array('id'=> '1', 'nombre' => 'Condominio', 'cant_personas' => '0','alicuota' => '100'));
		for ($i=2; $i < 102; $i++) 
		{ 
			Residencias::create(array('id'=> $i, 'nombre' => 'Casa #'.($i-1), 'cant_personas' => rand(1,6) ,'alicuota' => '1', 'persona_id_propietario' => rand(1,100) ,'solvencia' =>rand(0,1)));
		}
	 $this->command->info('Residencias Table Seed!');
	}

}