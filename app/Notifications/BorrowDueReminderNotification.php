<?php

namespace App\Notifications;

use App\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowDueReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Borrow $borrow
    ) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $book = $this->borrow->book;
        $due = $this->borrow->due_date?->format('F j, Y');

        return (new MailMessage)
            ->subject(__('Reminder: Book due soon'))
            ->greeting(__('Hello :name,', ['name' => $notifiable->name]))
            ->line(__('This is a reminder that ":title" is due on :date.', ['title' => $book->title, 'date' => $due]))
            ->action(__('View my borrows'), route('borrows.index'))
            ->line(__('Please return the book on time. Thank you!'));
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
