<?php

namespace App\Notifications;

use App\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowRejectedNotification extends Notification implements ShouldQueue
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

        return (new MailMessage)
            ->subject(__('Borrow request not approved'))
            ->greeting(__('Hello :name,', ['name' => $notifiable->name]))
            ->line(__('Your request to borrow ":title" could not be approved at this time.', ['title' => $book->title]))
            ->action(__('Browse other books'), route('books.index'))
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
