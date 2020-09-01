<?php

namespace MasterDmx\L2ppIntegration\Core;

class Repository
{
    protected $integration;

    public function __construct(Integration $integration)
    {
        $this->integration = $integration;
    }
}
