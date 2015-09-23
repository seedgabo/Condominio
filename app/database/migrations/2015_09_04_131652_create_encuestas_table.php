<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('encuestas', function($tabla)
		{
			$tabla->increments('id');
			$tabla->string('nombre', 100);
			$tabla->string("pregunta",255);
			$tabla->string("respuesta1",255)->nullable();
			$tabla->string("respuesta2",255)->nullable();
			$tabla->string("respuesta3",255)->nullable();
			$tabla->string("respuesta4",255)->nullable();
			$tabla->string("respuesta5",255)->nullable();
			$tabla->string("respuesta6",255)->nullable();
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
		Schema::drop('encuestas');
	}

}
