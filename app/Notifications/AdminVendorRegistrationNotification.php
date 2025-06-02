<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the admin vendor registration notification for the rfp_management_system.
 */
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminVendorRegistrationNotification extends Notification
{
    use Queueable;

    public $vendor;

    /**
     * Create a new notification instance.
     */
    public function __construct($vendor)
    {
        $this->vendor = $vendor;
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
            ->subject('New Vendor Registration')
            ->greeting('Hello Admin')
            ->line('A new vendor has registered:')
            ->line('Name: ' . $this->vendor->name)
            ->line('Email: ' . $this->vendor->email)
            ->action('View in Admin Panel', url('/admin/vendors'))
            ->salutation('Regards, RFP System');
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
