<?php

namespace App\Notifications;

use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LicenseVerificationReminder extends Notification
{
    use Queueable;
public $doctor;

    /**
     * Create a new notification instance.
     *
     * @param Doctor $doctor
     */
    public function __construct(Doctor $doctor)
    {
        $this->doctor=$doctor;
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
            ->line('Dear '.$this->doctor->user->doctor->first_name)
            ->line('Thank you for joining our application!')
            ->line('Now to provide your services, please verify your profile with a valid license key')
            ->line('To add or update your license, please click below button')
            ->action('Add or Update License', route('docAccount.information'))
            ->line('Thank you for using our application!');
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
