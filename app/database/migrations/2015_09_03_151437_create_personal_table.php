<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTable extends Migration {

	public function up()
	{
		Schema::create('personal', function($tabla)
		{
			$tabla->increments('id');
			$tabla->string('nombre', 100);
			$tabla->string("cedula",50)->nullable();
			$tabla->string("telefono",50)->nullable();
			$tabla->string("email",50)->nullable();
			$tabla->string("cargo",200)->nullable();
			$tabla->biginteger("residencia_id");
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
		Schema::drop('personal');
	}

}
