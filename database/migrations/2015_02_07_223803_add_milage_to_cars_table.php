<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMilageToCarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cars', function(Blueprint $table)
		{
			//
			$table->integer('mileage');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cars', function(Blueprint $table)
		{
			//
			$table->dropColumn('mileage');
		});
	}

}
