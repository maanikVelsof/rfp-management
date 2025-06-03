<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRfpNotification extends Notification
{
    use Queueable;
    public $rfp;

    /**
     * Create a new notification instance.
     */
    public function __construct($rfp)
    {
        $this->rfp = $rfp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New RFP Available')
            ->greeting('Hello ' . $notifiable->name)
            ->line('A new Request for Proposal (RFP) has been created.')
            ->line('Item: ' . $this->rfp->item_name)
            ->line('Last Date: ' . $this->rfp->last_date)
            // ->action('View RFPs', url('/vendor/rfps'))
            ->salutation('RFP System');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
