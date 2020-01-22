<?php

namespace App\Listeners;

use App\Events\CarreraFinalizadaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CarreraFinalizadaListener
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
     * @param  CarreraFinalizadaEvent  $event
     * @return void
     */
    public function handle(CarreraFinalizadaEvent $event)
    {
        //
    }
}
