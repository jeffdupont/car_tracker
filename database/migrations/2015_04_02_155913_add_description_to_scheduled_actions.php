<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToScheduledActions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('scheduled_actions', function(Blueprint $table)
		{
			//
			$table->text('details');
			$table->string('type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('scheduled_actions', function(Blueprint $table)
		{
			//
			$table->dropColumn('details');
			$table->dropColumn('type');
		});
	}

}
