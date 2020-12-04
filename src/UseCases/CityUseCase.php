<?php

namespace MasterDmx\LaravelL2ppIntegration\UseCases;

use MasterDmx\LaravelL2ppIntegration\Events\CityCreatedEvent;
use MasterDmx\LaravelL2ppIntegration\Events\CityRemovedEvent;
use MasterDmx\LaravelL2ppIntegration\Events\CitySyncedAllEvent;
use MasterDmx\LaravelL2ppIntegration\Events\CityUpdatedEvent;
use MasterDmx\LaravelL2ppIntegration\Models\City;
use MasterDmx\LaravelL2ppIntegration\Repositories\CityRepository;
use MasterDmx\LaravelL2ppIntegration\Services\SyncModelService;

class CityUseCase
{
    /**
     * @var \MasterDmx\LaravelL2ppIntegration\Repositories\CityRepository
     */
    private $repository;

    /**
     * @var \MasterDmx\LaravelL2ppIntegration\Models\City
     */
    private $model;

    /**
     * @var \MasterDmx\LaravelL2ppIntegration\Services\SyncModelService
     */
    private $syncService;

    public function __construct(CityRepository $repository, City $model, SyncModelService $syncService)
    {
        $this->repository = $repository;
        $this->model = $model;
        $this->syncService = $syncService;
    }

    /**
     * Синхронизировать все
     *
     * @return void
     */
    public function syncAll()
    {
        // Получаем все города с L2PP
        $cities = $this->repository->all();

        if ($cities && $cities->count() > 0) {
            // Убираем лишниее
            $cities = $this->syncService->removeUnsyncAttributesFromCollection($cities, $this->model);

            // Удаляем все города из локальной БД
            $this->model->truncate();

            // Выполняем запись всех городов в БД
            $this->model->insert($cities->toArray());

            event(new CitySyncedAllEvent());
        }
    }

    public function create(int $id)
    {
        if ($city = $this->repository->find($id)) {
            $this->model->destroy($id);
            $this->model->create($city);
            event(new CityCreatedEvent($id));
        }
    }

    public function update(int $id)
    {
        if ($city = $this->repository->find($id)) {
            $this->model->destroy($id);
            $this->model->create($city);
            event(new CityUpdatedEvent($id));
        }
    }

    public function destroy(int $id)
    {
        $this->model->destroy($id);
        event(new CityRemovedEvent($id));
    }
}
