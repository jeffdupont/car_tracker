<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScheduledActionIdToMaintenanceLogs extends Migration {

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
			$table->integer('scheduled_action_id')->default(0);
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
			$table->dropColumn('scheduled_action_id');
		});
	}

}
