<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration {

	public function up()
	{
		Schema::create('noticias', function($tabla)
		{
			$tabla->increments('id');
			$tabla->string('titulo', 50);
			$tabla->text('contenido');
			$tabla->string('persona', 200)->nullable();
			$tabla->integer('user_id')->nullable();
			$tabla->date('fecha')->nullable();
			$tabla->string('media',200)->nullable();
			$tabla->timestamps();

		});
	}
	public function down()
	{
		Schema::drop('noticias');
	}

}
