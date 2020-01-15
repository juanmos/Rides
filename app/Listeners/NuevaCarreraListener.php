<?php

namespace App\Listeners;

use App\Events\NuevaCarreraEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NuevaCarreraListener
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
     * @param  NuevaCarreraEvent  $event
     * @return void
     */
    public function handle(NuevaCarreraEvent $event)
    {
        //
    }
}
