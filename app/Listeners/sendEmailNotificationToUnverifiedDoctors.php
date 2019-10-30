<?php

namespace App\Listeners;

use App\Notifications\LicenseVerificationReminder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmailNotificationToUnverifiedDoctors
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $doctor=$event->doctor;
        $user = $event->doctor->user;
        $user->notify(new LicenseVerificationReminder($doctor));
    }
}
