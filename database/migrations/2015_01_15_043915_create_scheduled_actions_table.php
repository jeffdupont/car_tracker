<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledActionsTable extends Migration {

	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('scheduled_actions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('car_id');
			$table->string('action');
			$table->text('scheduled_at');
			$table->timestamps();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::drop('scheduled_actions');
	}

}

// scheduled at:
/*
JSON OBJECT
start: 					start date. date. required.
every: 					interval magnitude (every XXX weeks...). integer. required.
unit: 					valid values are 'd', 'w', 'm', 'y' for days, weeks, months, and years respectively. probably required.

end_condition: 	how should the recurrence be terminated. valid values are 'until' and 'for'. 'until' should be a date. 'for' should be an integer (for N occurrences).
until: 					if end_condition is 'until', pass the date here.
rfor: 					if end_condition is 'for', pass an integer here.

// 'm' unit
nth: 						valid values are 'first', 'second', 'third', 'fourth', and 'last'. see 'occurrence_of' option. to be used with 'm' unit option.
occurrence_of: 	valid values are 0-6, corresponding to the days of the week. in conjuction with 'nth' option, specifies nth day of the month (last Sunday of the month). to be used with 'm' unit option.

// 'w' unit
days: 					to be used with 'w' unit option. an array of integers representing day of the week (0-6). eg. Every 2 weeks on Tuesday (2) and Thursday (4), pass [2,4] as the value.
*/
