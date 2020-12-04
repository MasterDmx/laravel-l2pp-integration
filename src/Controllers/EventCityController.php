<?php

namespace MasterDmx\LaravelL2ppIntegration\Controllers;

use MasterDmx\LaravelL2ppIntegration\Jobs\CityCrudJob;
use MasterDmx\LaravelL2ppIntegration\Jobs\CitySyncJob;

class EventCityController extends EventController
{
    public function syncAll()
    {
        $this->dispatch(new CitySyncJob());
    }

    public function update()
    {
        debug_print(12312312);
        $this->dispatch(new CityCrudJob($this->request->input('id') ?? 0, 'update'));
    }

    public function create()
    {
        $this->dispatch(new CityCrudJob($this->request->input('id') ?? 0, 'create'));
    }

    public function destroy()
    {
        $this->dispatch(new CityCrudJob($this->request->input('id') ?? 0, 'destroy'));
    }
}
