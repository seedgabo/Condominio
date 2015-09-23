<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestasRespuestasTable extends Migration {
	public function up()
	{
			Schema::create('encuestas_respuestas', function($tabla)
		{
			$tabla->increments('id');
			$tabla->biginteger('respuesta');
			$tabla->biginteger('encuesta_id');
			$tabla->biginteger('persona_id');
			$tabla->string("comentarios",500)->nullable();
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
		Schema::drop('encuestas_respuestas');
	}

}
