<?php

namespace MasterDmx\LaravelL2ppIntegration\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use MasterDmx\LaravelL2ppIntegration\UseCases\CityUseCase;

class CitySyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 20;

    public function handle(CityUseCase $case)
    {
        Log::debug('Start job CitySyncJob');
        $case->syncAll();
    }
}
