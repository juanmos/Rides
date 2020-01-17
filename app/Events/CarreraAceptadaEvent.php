<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarreraAceptadaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $carrera;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($carrera)
    {
        $this->carrera = $carrera;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('carrera.'.$this->carrera->id);
    }

    public function broadcastAs()
    {
        return 'carrera.aceptada';
    }

    public function broadcastWith()
    {
        return ['id' => $this->carrera->id,'conductor_id'=>$this->carrera->conductor_id];
    }
}
