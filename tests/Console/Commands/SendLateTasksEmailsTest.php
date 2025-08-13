<?php

namespace Tests\Console\Commands;

use App\Enums\TaskStatus;
use App\Mail\TasksReminderMail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Task;
use App\Mail\OverdueTasksMail;
use Carbon\Carbon;

class SendLateTasksEmailsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_sends_emails_to_users_with_overdue_tasks()
    {
        Mail::fake();

        // Freeze time for consistent results
        Carbon::setTestNow(Carbon::create(2025, 8, 13));

        // Create a user with an overdue task
        $user = User::factory()->create();
        $overdueTask = Task::factory()->create([
            'user_id'   => $user->id,
            'title'     => 'Overdue task example',
            'completion_date'  => now()->subDays(3),
            'status'    => TaskStatus::ToDo,
        ]);

        // Create a user with no overdue tasks (should NOT get email)
        $userNoOverdue = User::factory()->create();
        Task::factory()->create([
            'user_id'   => $userNoOverdue->id,
            'completion_date'  => now()->addDays(5),
            'status'    => TaskStatus::ToDo,
        ]);

        // Run the command
        $this->artisan('app:send-late-tasks-emails')
            ->assertExitCode(0);

        // Assert mail sent only to the user with overdue tasks
        Mail::assertSent(TasksReminderMail::class, function ($mail) use ($user, $overdueTask) {
            return $mail->hasTo($user->email)
                && $mail->tasks->contains($overdueTask);
        });

        Mail::assertNotSent(TasksReminderMail::class, function ($mail) use ($userNoOverdue) {
            return $mail->hasTo($userNoOverdue->email);
        });
    }
}
