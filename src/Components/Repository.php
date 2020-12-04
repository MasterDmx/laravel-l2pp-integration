<?php

namespace MasterDmx\LaravelL2ppIntegration\Components;

class Repository
{
    protected $integration;

    public function __construct(Integration $integration)
    {
        $this->integration = $integration;
    }
}
