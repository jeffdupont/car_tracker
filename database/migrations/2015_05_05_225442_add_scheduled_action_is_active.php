<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScheduledActionIsActive extends Migration {

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
      $table->boolean('is_active')->default(1);
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
      $table->dropColumn('is_active');
		});
	}

}
