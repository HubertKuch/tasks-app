<?php

namespace App\Console\Commands;

use App\Enums\TaskStatus;
use App\Mail\TasksReminderMail;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendLateTasksEmails extends Command
{
    protected $signature = 'app:send-late-tasks-emails';

    protected $description = 'Command description';

    public function handle(): int
    {
        $today = Carbon::today();

        $overdueTasks = Task::where('completion_date', '<', $today)
            ->where('status', '!=', TaskStatus::Done->value)
            ->with('user')
            ->get()
            ->groupBy('user_id');

        if ($overdueTasks->isEmpty()) {
            $this->info('No overdue tasks found.');

            return Command::SUCCESS;
        }

        foreach ($overdueTasks as $userId => $tasks) {
            $user = $tasks->first()->user;

            Mail::to($user->email)->send(new TasksReminderMail($user, $tasks));
        }

        return Command::SUCCESS;
    }
}
