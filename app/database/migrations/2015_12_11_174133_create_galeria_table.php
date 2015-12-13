<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('galeria', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("nombre",300);
			$table->bigInteger("persona_id");
			$table->string("path",100);
			$table->string("album",50);
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
		Schema::drop('galeria');
	}

}
