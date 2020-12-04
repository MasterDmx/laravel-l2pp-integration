<?php

namespace MasterDmx\LaravelL2ppIntegration\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CityCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
