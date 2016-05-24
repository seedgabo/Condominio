<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
public function up()
	{
		Schema::create('residencias', function($tabla)
		{
			$tabla->increments('id');
			$tabla->string('nombre', 50)->unique();
			$tabla->boolean("solvencia")->nullable()->default("0");
			$tabla->bigInteger('cant_personas')->nullable();
			$tabla->bigInteger('persona_id_propietario')->nullable();
			$tabla->decimal('alicuota');
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
		Schema::drop('residencias');
	}
}
