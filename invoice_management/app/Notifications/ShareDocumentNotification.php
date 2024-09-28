<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShareDocumentNotification extends Notification
{
    use Queueable;
    private $documentData;

    /**
     * Create a new notification instance.
     */
    public function __construct($documentData)
    {
        $this->documentData = $documentData;
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
        $customerName = $this->documentData['name'];
        return (new MailMessage)
            ->line("Dear $customerName, you have received shared documents.")
            // ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->documentData['name'],
            'body' => $this->documentData['body'],
            'thanks' => $this->documentData['thanks'],
            'offer_id' => $this->documentData['offer_id'],
        ];
    }
}
