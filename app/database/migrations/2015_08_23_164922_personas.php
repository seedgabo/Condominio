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
			//varchar 50
			$tabla->string('nombre', 100);
			//varchar 100
			$tabla->string('email', 100)->unique();
			//varchar 200 para encriptar los passwords
			$tabla->string('password', 200);
			
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
