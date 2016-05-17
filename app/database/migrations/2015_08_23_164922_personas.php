<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Personas extends Migration {

	public function up()
	{
		Schema::create('personas', function($tabla)
		{

			// id auto incremental primary key
			$tabla->increments('id');

			$tabla->string('nombre', 100);

			$tabla->string('email', 100)->unique();

			$tabla->string('telefono',50)->nullable();

			$tabla->string('cedula',50)->nullable();

			$tabla->string('observaciones',200)->nullable();

			//varchar 200 para encriptar los passwords
			$tabla->string('password', 200);

			$tabla->string('avatar',200)->nullable();

			$tabla->timestamp('last_login')->nullable();

 			$tabla->bigInteger('residencia_id')->nullable();

 			$tabla->boolean('admin')->default('0');

			$tabla->rememberToken()->nullable();
			$tabla->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('personas');
	}

}
