<?php

namespace App\Notifications;

use App\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowApprovedNotification extends Notification implements ShouldQueue
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
            ->subject(__('Borrow request approved'))
            ->greeting(__('Hello :name,', ['name' => $notifiable->name]))
            ->line(__('Your request to borrow ":title" has been approved.', ['title' => $book->title]))
            ->when($due, fn (MailMessage $m) => $m->line(__('Due date: :date', ['date' => $due])))
            ->action(__('View my borrows'), route('borrows.index'))
            ->line(__('Thank you for using our library!'));
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
