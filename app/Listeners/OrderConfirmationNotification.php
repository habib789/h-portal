<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmationNotification
{

    /**
     * Create the event listener.
     *
     * @param Order $order
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
        $order = $event->order;
        $user = $event->order->user;
        $user->notify(new \App\Notifications\OrderConfirmationNotification($order));
    }
}
