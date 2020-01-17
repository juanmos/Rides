<?php

namespace App\Listeners;

use App\Events\CarreraAceptadaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CarreraAceptadaListener
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
     * @param  CarreraAceptadaEvent  $event
     * @return void
     */
    public function handle(CarreraAceptadaEvent $event)
    {
        //
    }
}
