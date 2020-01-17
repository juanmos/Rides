<?php

namespace App\Listeners;

use App\Events\TaxiLlegoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaxiLlegoListener
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
     * @param  TaxiLlegoEvent  $event
     * @return void
     */
    public function handle(TaxiLlegoEvent $event)
    {
        //
    }
}
