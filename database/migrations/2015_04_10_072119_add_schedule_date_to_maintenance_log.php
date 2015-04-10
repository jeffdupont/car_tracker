<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScheduleDateToMaintenanceLog extends Migration {

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
			$table->date('scheduled_at');
			$table->boolean('is_completed')->default(0);
			$table->dateTime('completed_at');
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
			$table->dropColumn('scheduled_at');
			$table->dropColumn('is_completed');
			$table->dropColumn('completed_at');
		});
	}

}
