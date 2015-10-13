<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturas', function($tabla)
		{
			$tabla->increments('id');
			$tabla->string('mes', 50);
			$tabla->string('año', 50);
			$tabla->decimal("monto",20,3);
			$tabla->string("concepto",50);
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
		Schema::drop('facturas');
	}

}
