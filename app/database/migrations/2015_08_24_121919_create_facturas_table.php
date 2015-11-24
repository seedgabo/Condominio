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
			$tabla->integer('mes');
			$tabla->integer('año');
			$tabla->biginteger('residencia_id')->nullable();
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
