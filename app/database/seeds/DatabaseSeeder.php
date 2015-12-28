<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		// $this->command->info('User table seeded!');
		$this->call('residenciasTableSeeder');
		// $this->command->info('residencias table seeded!');
		$this->Call('AreasTableSeeder');
		// $this->command->info('Areas Table Seed!');
		$this->Call('FacturasTableSeeder');
		// $this->command->info('Facturas Table Seed! and Receipment added');
		$this->Call('NoticiasTableSeeder');
		// $this->command->info('Noticias and eventos Table Seed!');
		$this->Call('EncuestasTableSeeder');
		// $this->command->info('Encuestas and Respuestas Table Seed!');
		$this->Call('DirectivaTableSeeder');
		// $this->command->info('Directiva Table Seed!');
		$this->Call('PersonalTableSeeder');
		// $this->command->info('Personal Table Seed!');
		$this->Call('SolvenciaTableSeeder');
		// $this->command->info('Solvencia Table Seed!');
	}


}
