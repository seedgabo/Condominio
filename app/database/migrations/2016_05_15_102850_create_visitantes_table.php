<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitantes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('cedula');
			$table->string('telefono')->nullable();
			$table->string('email')->nullable();
			$table->integer("residencia_id");
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visitantes');
	}

}
