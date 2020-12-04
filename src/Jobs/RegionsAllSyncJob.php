<?php

namespace MasterDmx\LaravelL2ppIntegration\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MasterDmx\LaravelL2ppIntegration\UseCases\RegionUseCase;

class RegionsAllSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 20;

    public function handle(RegionUseCase $case)
    {
        $case->syncAll();
    }
}
