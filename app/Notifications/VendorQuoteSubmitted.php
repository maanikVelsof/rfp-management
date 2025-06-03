<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorQuoteSubmitted extends Notification
{
    use Queueable;

    protected $rfp;
    protected $quote;

    /**
     * Create a new notification instance.
     */
    public function __construct($rfp, $quote)
    {
        $this->rfp = $rfp;
        $this->quote = $quote;
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
        $greeting = 'Hello';
        if (isset($notifiable->name)) {
            $greeting .= ' ' . $notifiable->name;
        }

        return (new MailMessage)
            ->subject('New Quote Submitted for RFP #' . $this->rfp->rfp_number)
            ->greeting($greeting)
            ->line('A new quote has been submitted for RFP #' . $this->rfp->rfp_number . '.')
            ->line('Item: ' . $this->rfp->item_name)
            ->line('Last Date: ' . $this->rfp->last_date)
            ->line('Price Per Unit: ' . number_format($this->quote->price_per_unit, 2))
            ->line('Quantity: ' . $this->quote->quantity)
            ->line('Total Cost: ' . number_format($this->quote->total_cost, 2))
            ->line('Item Description: ' . $this->quote->item_description)
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
