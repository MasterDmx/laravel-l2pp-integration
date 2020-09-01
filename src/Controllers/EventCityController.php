<?php

namespace MasterDmx\L2ppIntegration\Controllers;

use MasterDmx\L2ppIntegration\Jobs\CrudCityJob;
use MasterDmx\L2ppIntegration\Jobs\SyncAllCitiesJob;

class EventCityController extends EventController
{
    public function syncAll()
    {
        $this->dispatch(new SyncAllCitiesJob());
    }

    public function update()
    {
        $this->dispatch(new CrudCityJob($this->request->input('id') ?? 0, 'update'));
    }

    public function create()
    {
        $this->dispatch(new CrudCityJob($this->request->input('id') ?? 0, 'create'));
    }

    public function destroy()
    {
        $this->dispatch(new CrudCityJob($this->request->input('id') ?? 0, 'destroy'));
    }
}
