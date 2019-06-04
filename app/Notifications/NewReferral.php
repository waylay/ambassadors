<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewReferral extends Notification
{
    use Queueable;

    private $ambassador;
    private $referral;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($notification)
    {
        $this->ambassador = $notification['ambassador'];
        $this->referral = $notification['referral'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New referral from '. $this->ambassador->name)
                    ->greeting('Hello '. $notifiable->name . '!')
                    ->salutation(' ')
                    ->line( $this->ambassador->name . ' referred ' .$this->referral->name )
                    ->action('Open Dashboard', route('dashboard'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
