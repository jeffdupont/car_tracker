<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maintenance_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('car_id');
			$table->string('action');
			$table->timestamps();

			$table->index('user_id');
			$table->index('car_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maintenance_logs');
	}

}
