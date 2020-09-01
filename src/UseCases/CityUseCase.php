<?php

namespace MasterDmx\L2ppIntegration\UseCases;

use MasterDmx\L2ppIntegration\Models\City;
use MasterDmx\L2ppIntegration\Repositories\CityRepository;
use MasterDmx\L2ppIntegration\Services\SyncModelService;

class CityUseCase
{
    /**
     * @var \MasterDmx\L2ppIntegration\Repositories\CityRepository
     */
    private $repository;

    /**
     * @var \MasterDmx\L2ppIntegration\Models\City
     */
    private $model;

    /**
     * @var \MasterDmx\L2ppIntegration\Services\SyncModelService
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
        }
    }

    public function update(int $id)
    {
        // Получаем данные с L2PP
        if ($city = $this->repository->find($id)) {
            // Удаляем локальный город
            $this->model->destroy($id);

            // Записываем данные
            $this->model->create($city);
        }
    }

    public function destroy(int $id)
    {
        $this->model->destroy($id);
    }
}
