<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * The password reset token to be sent
     * to the user.
     * @var string
     */
    protected $token;

    /**
     * The url the password reset button
     * would redirect to.
     * @var string
     */
    protected $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $url = null)
    {
        $this->token = $token;
        
        $this->url = is_null($url) ? config('app.user-domain') . "/reset-password/". $this->token  : $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'mail' ];
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
                    ->from('no-reply@incharge.com.ng', 'InCharge')
                    ->line('Hi ' . $notifiable->name . ',')
                    ->line('We received a request to reset your In-Charge password. Click the link below to choose a new one:')
                    ->action('Reset Your Password', $this->url)
                    ->line('If you did not make this request, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
