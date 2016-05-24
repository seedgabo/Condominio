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
		$this->call('residenciasTableSeeder');
		$this->Call('AreasTableSeeder');
		$this->Call('FacturasTableSeeder');
		$this->Call('NoticiasTableSeeder');
		$this->Call('EncuestasTableSeeder');
		$this->Call('DirectivaTableSeeder');
		$this->Call('PersonalTableSeeder');
		$this->Call('SolvenciaTableSeeder');
		$this->Call('VehiculosTableSeeder');
		$this->Call('VisitantesTableSeeder');
		$this->Call('DocumentosTableSeeder');

		Eloquent::reguard();
	}


}
