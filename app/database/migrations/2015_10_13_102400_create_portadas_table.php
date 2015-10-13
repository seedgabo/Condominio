<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortadasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portadas', function($tabla)
		{
			$tabla->increments('id');
			$tabla->string("titulo",50)->nullable();
			$tabla->string("contenido",500)->nullable();
			$tabla->string("media", 200)->nullable();
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
		Schema::drop('portadas');	}

	}
