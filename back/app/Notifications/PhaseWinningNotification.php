<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PhaseWinningNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $phase;
    private $tournament;
    private $idea;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($phase, $tournament)
    {
        $this->phase = $phase;
        $this->tournament = $tournament;
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
            ->subject('Phase winning notification')
            ->line("Hello $notifiable->name, you've won " . $this->phase . " phase of the " . $this->tournament->name . " .")
            ->action('Check Now', '#')
            ->line('Thank you!');
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
