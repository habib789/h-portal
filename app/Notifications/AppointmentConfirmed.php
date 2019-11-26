<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentConfirmed extends Notification
{
    use Queueable;
    public $appointment;

    /**
     * Create a new notification instance.
     *
     * @param Appointment $apt
     */
    public function __construct(Appointment $apt)
    {
        $this->appointment = $apt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Dear .' . $this->appointment->patient->first_name)
            ->line('Your appointment has been created successfully.')
            ->line('Payment Received.')
            ->line('Transaction Code: '. $this->appointment->transaction_code)
            ->line('Doctor name: Dr.'. $this->appointment->doctor->first_name)
            ->line('Appointment date: '. date('d-m-Y', strtotime($this->appointment->appointment_date)))
//            ->line('Appointment time :'. date('h:i AM', strtotime($this->appointment->appointment_time)))
            ->line('Be right there in time.')
            ->action('See appointments', route('myAppointments'))
            ->line('Thank you for using our application!');
    }

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
}
