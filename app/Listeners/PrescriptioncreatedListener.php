<?php

namespace App\Listeners;

use App\Notifications\PrescriptionUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrescriptioncreatedListener
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
        $report = $event->report;
        $user = $event->report->patient->user;
        $user->notify(new PrescriptionUpdate($report));
    }
}
