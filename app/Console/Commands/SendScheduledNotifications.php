<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\MaintenanceLog;
use App\Models\User;

class SendScheduledNotifications extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'schedule:send-notifications';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send out notifications to the users for any outstanding maintenance actions.';

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
	public function fire()
	{
		//
		$actions = MaintenanceLog::where('scheduled_at', '<=', \Carbon\Carbon::now()->format('Y-m-d'))->where('is_completed', false)->get();
		$notification_users = User::where('status', true)->where('is_notified', true)->lists('email');
		print_r($notification_users);

		foreach( $actions as $action ) {
			print_r($action);
		}
	}

	// /**
	//  * Get the console command arguments.
	//  *
	//  * @return array
	//  */
	// protected function getArguments()
	// {
	// 	return [
	// 		['example', InputArgument::REQUIRED, 'An example argument.'],
	// 	];
	// }

	// /**
	//  * Get the console command options.
	//  *
	//  * @return array
	//  */
	// protected function getOptions()
	// {
	// 	return [
	// 		['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
	// 	];
	// }

}
