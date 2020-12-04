<?php

namespace MasterDmx\LaravelL2ppIntegration\Controllers;

use MasterDmx\LaravelL2ppIntegration\Jobs\RegionCrudJob;
use MasterDmx\LaravelL2ppIntegration\Jobs\RegionsAllSyncJob;

class EventOrganizationController extends EventController
{
    public function syncAll()
    {
        $this->dispatch(new RegionsAllSyncJob());
    }

    public function update()
    {
        $this->dispatch(new RegionCrudJob($this->request->input('id') ?? 0, 'update'));
    }

    public function create()
    {
        $this->dispatch(new RegionCrudJob($this->request->input('id') ?? 0, 'create'));
    }

    public function destroy()
    {
        debug_print(config('queue.default'));

        $this->dispatch(new RegionCrudJob($this->request->input('id') ?? 0, 'destroy'));
    }
}
