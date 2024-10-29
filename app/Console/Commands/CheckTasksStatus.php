<?php

namespace App\Console\Commands;

use App\Enums\TaskStatus;
use App\Jobs\SendTaskStatusEmail;
use App\Models\User;
use Illuminate\Console\Command;

class CheckTasksStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-tasks-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $users = User::select('id', 'name', 'email')
            ->with('tasks:title,due_date,status,user_id')
            ->whereRelation('tasks', 'status', '=', TaskStatus::PINDING->value)
            ->get();
        foreach ($users as $user) {
            $pindingTasks = $user->tasks;
            $pindingTasks  = $pindingTasks->toArray();
            if (!empty($pindingTasks))
                SendTaskStatusEmail::dispatch($user, $pindingTasks);
        }
    }
}
