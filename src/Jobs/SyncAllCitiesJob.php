<?php

namespace MasterDmx\L2ppIntegration\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MasterDmx\L2ppIntegration\UseCases\CityUseCase;

class SyncAllCitiesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 20;

    public function handle(CityUseCase $case)
    {
        $case->syncAll();
    }
}
