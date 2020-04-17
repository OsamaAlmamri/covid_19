<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderAcceptNotification extends Notification
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//            ->line('The introduction to the notification.')
//            ->action('Notification Action', url('/'))
//            ->line('Thank you for using our application!');
//    }
//

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->details['message'],
            'sender_name' => $this->details['sender_name'],
            'sender_image' => $this->details['sender_image'],
            'order_id' => $this->details['order_id'],
            'customer_id' => $this->details['customer_id'],
            'user_id' => $this->details['user_id'],
            'date' => $this->details['date'],
        ];
    }
}
