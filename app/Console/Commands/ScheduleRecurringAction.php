<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\ScheduledAction;
use App\Models\MaintenanceLog;

use Recur\Recur;

class ScheduleRecurringAction extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'schedule:recurring-action';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Attempts to add new scheduled maintanence alerts.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
    //
    $car_id = $this->argument('car_id');

		// get all active scheduled actions
		if( ! empty($car_id) )
      $scheduled_actions = ScheduledAction::where('car_id', $car_id)->get();
    else
      $scheduled_actions = ScheduledAction::all();

    // loop through each action and check if it needs to be scheduled
    foreach( $scheduled_actions as $action ) {
      $schedule = json_decode($action->scheduled_at, true);

      if( ! empty($schedule) ) {
        // get the next occurance
        $recur = Recur::create($schedule)->from(\Carbon\Carbon::now());
        $next_dates = $recur->next(3, 'Y-m-d');

        foreach( $next_dates as $next_date ) {
          if( ! MaintenanceLog::where('car_id', $action->car_id)->where('scheduled_at', $next_date)->where('scheduled_action_id', $action->id)->exists() ) {
            // create the new maintenance action
            $log_action = new MaintenanceLog();
            $log_action->user_id = 0;
            $log_action->car_id = $action->car_id;
            $log_action->action = $action->action;
            $log_action->additional_data = json_encode([ 'description' => $action->details ]);
            $log_action->scheduled_at = $next_date;
            $log_action->scheduled_action_id = $action->id;
            $log_action->save();

            $this->info('Create scheduled action [' . $action->action . '] for car ' . $action->car->display . ' on ' . \Carbon\Carbon::parse($next_date)->format('l, F dS, Y') . '.');
          }
        }
      }
    }

    $this->info('Done.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			[ 'car_id', InputArgument::OPTIONAL, 'The car id to schedule the recurring actions with.' ],
		];
	}

}
