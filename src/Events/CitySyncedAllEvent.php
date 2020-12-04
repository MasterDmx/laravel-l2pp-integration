<?php

namespace MasterDmx\LaravelL2ppIntegration\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CitySyncedAllEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
}
