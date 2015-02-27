<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaintenanceActionData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('maintenance_logs', function(Blueprint $table)
		{
			//
			$table->text('additional_data');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('maintenance_logs', function(Blueprint $table)
		{
			//
			$table->dropColumn('additional_data');
		});
	}

}
