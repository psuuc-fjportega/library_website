<?php

namespace App\Console\Commands;

use App\Models\Borrow;
use App\Notifications\BorrowDueReminderNotification;
use Illuminate\Console\Command;

class SendBorrowDueReminders extends Command
{
    protected $signature = 'borrows:send-due-reminders';

    protected $description = 'Send email reminders for borrows due soon';

    public function handle(): int
    {
        $days = config('library.due_reminder_days_before', 1);
        $targetDate = now()->addDays($days)->toDateString();

        $borrows = Borrow::query()
            ->where('status', Borrow::STATUS_APPROVED)
            ->whereDate('due_date', $targetDate)
            ->with('book')
            ->get();

        foreach ($borrows as $borrow) {
            $borrow->user->notify(new BorrowDueReminderNotification($borrow));
        }

        $this->info("Sent {$borrows->count()} due reminder(s).");

        return self::SUCCESS;
    }
}
