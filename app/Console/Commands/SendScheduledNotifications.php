<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Models\MaintenanceLog;
use App\Models\User;

class SendScheduledNotifications extends Command
{
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
        // get all actions due today or are overdue
        $actions = MaintenanceLog::where('scheduled_at', '<=', \Carbon\Carbon::now()->format('Y-m-d'))->where('is_completed', false)->orderBy('scheduled_at')->get();

        // get a list of users that are set to receive email notifications
        $users = User::where('status', true)->where('is_notified', true)->lists('email', 'display_name');

        if (! empty($actions)) {
            $due = [];
            $overdue = [];
            foreach ($actions as $action) {
                if ($action->scheduled_at->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d')) {
                    $due[] = $action;
                } elseif ($action->scheduled_at->lt(\Carbon\Carbon::now())) {
                    $overdue[] = $action;
                }
            }

            if (! $this->option('debug')) {
                \Mail::send('emails.notification', [ 'due' => $due, 'overdue' => $overdue ], function ($message) use ($users) {
                    foreach ($users as $user => $email) {
                        $message->to($email, $user);
                    }
                });
            } else {
                \Mail::pretend('emails.notification', [ 'due' => $due, 'overdue' => $overdue ], function ($message) use ($users) {
                    foreach ($users as $user => $email) {
                        $message->to($email, $user);
                    }
                });
            }
        }

        $this->info('Done.');
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

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [ 'debug', null, InputOption::VALUE_OPTIONAL, 'Set to true if you don\'t want to send the emails.', null ],
        ];
    }
}
