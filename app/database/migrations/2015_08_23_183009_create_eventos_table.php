<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos', function($tabla) 
		{
 
			$tabla->increments('id');
			$tabla->string('razon', 50);
			$tabla->date('fecha_ini');
			$tabla->date('fecha_fin');
			$tabla->time('tiempo_ini');
			$tabla->time('tiempo_fin');
			$tabla->string('persona',50)->nullable();
			$tabla->string('areas',200)->nullable();
			$tabla->timestamps();
 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventos');
	}

}
