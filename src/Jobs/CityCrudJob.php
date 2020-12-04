<?php

namespace MasterDmx\LaravelL2ppIntegration\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use MasterDmx\LaravelL2ppIntegration\UseCases\CityUseCase;

class CityCrudJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    private $id;
    private $mode;

    public function __construct(int $id, string $mode = 'update')
    {
        $this->id = $id;
        $this->mode = $mode;
    }

    public function handle(CityUseCase $case)
    {
        Log::debug('Start job CityCrudJob');

        if ($this->mode === 'create' || $this->mode === 'update') {
            $case->update($this->id);
        } elseif ($this->mode === 'destroy') {
            $case->destroy($this->id);
        }

        return 'sagasd';
    }
}
