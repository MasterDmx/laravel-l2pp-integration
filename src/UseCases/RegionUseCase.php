<?php

namespace MasterDmx\LaravelL2ppIntegration\UseCases;

use MasterDmx\LaravelL2ppIntegration\Models\Region;
use MasterDmx\LaravelL2ppIntegration\Repositories\RegionRepository;
use MasterDmx\LaravelL2ppIntegration\Services\SyncModelService;

class RegionUseCase
{
    /**
     * @var \MasterDmx\LaravelL2ppIntegration\Repositories\RegionRepository
     */
    private $repository;

    /**
     * @var \MasterDmx\LaravelL2ppIntegration\Models\Region
     */
    private $model;

    /**
     * @var \MasterDmx\LaravelL2ppIntegration\Services\SyncModelService
     */
    private $syncService;

    public function __construct(RegionRepository $repository, Region $model, SyncModelService $syncService)
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
        $rows = $this->repository->all();

        if ($rows && $rows->count() > 0) {
            // Убираем лишниее
            $rows = $this->syncService->removeUnsyncAttributesFromCollection($rows, $this->model);

            // Удаляем все города из локальной БД
            $this->model->truncate();

            // Выполняем запись всех городов в БД
            $this->model->insert($rows->toArray());
        }
    }

    public function update(int $id)
    {
        // Получаем данные с L2PP
        if ($row = $this->repository->find($id)) {
            // Удаляем локальный город
            $this->model->destroy($id);

            // Записываем данные
            $this->model->create($row);
        }
    }

    public function destroy(int $id)
    {
        $this->model->destroy($id);
    }
}
