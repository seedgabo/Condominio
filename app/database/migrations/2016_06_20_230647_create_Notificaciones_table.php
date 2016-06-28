<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Notificaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titulo');
			$table->string('mensaje');
			$table->boolean('leido')->default(0);
			$table->boolean('admin')->default(0);
			$table->integer('user_id');
			$table->string('url');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Notificaciones');
	}

}
