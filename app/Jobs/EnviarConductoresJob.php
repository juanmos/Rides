<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EnviarConductoresJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $carrera;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($carrera)
    {
        $this->carrera=$carrera;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $conductores = $this->carrera->empresa->conductores;
        foreach($conductores as $conductor){
            $conductor->notify(new NuevaCarreraConductorNotification($this->carrera));
        }
    }
}
