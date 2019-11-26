<?php

namespace App\Providers;

use App\Events\AppointmentConfirmed;
use App\Events\notifyUnverifiedDoctors;
use App\Events\OrderCreate;
use App\Listeners\OrderConfirmationNotification;
use App\Listeners\sendEmailNotificationToUnverifiedDoctors;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreate::class =>[
          OrderConfirmationNotification::class,
        ],
        notifyUnverifiedDoctors::class=>[
          sendEmailNotificationToUnverifiedDoctors::class,
        ],
        AppointmentConfirmed::class=>[
            \App\Listeners\AppointmentConfirmed::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
