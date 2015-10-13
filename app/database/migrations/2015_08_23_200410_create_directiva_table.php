<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectivaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('directiva', function($tabla)
		{
			$tabla->increments('id');
			$tabla->string('nombre', 50);
			$tabla->string('email');
			$tabla->string('telefono');
			$tabla->string('cargo');
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
		Schema::drop('directiva');
	}

}
