<?php

namespace App\Listeners;

use App\Events\CarreraCanceladaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CarreraCanceladaListener
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
     * @param  CarreraCanceladaEvent  $event
     * @return void
     */
    public function handle(CarreraCanceladaEvent $event)
    {
        //
    }
}
