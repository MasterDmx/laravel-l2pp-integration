<?php

namespace MasterDmx\LaravelL2ppIntegration\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MasterDmx\LaravelL2ppIntegration\Contracts\SynchronizableModel;

class SyncModelService
{
    /**
     * Проверить аттрибут на разрешение синхронизации
     *
     * @param string $attribute
     * @param SynchronizableModel $model
     * @return bool
     */
    public function checkAttributeForSync(string $attribute, SynchronizableModel $model): bool
    {
        return in_array($attribute, $model->getSyncAttributes());
    }

    /**
     * Удалить несинхронизируемые аттрибуты
     *
     * @param array $attributes
     * @param SynchronizableModel $model
     * @return array
     */
    public function removeUnsyncAttributes(array $attributes, SynchronizableModel $model): array
    {
        foreach (array_keys($attributes) as $key) {
            if (!$this->checkAttributeForSync($key, $model)) {
                unset($attributes[$key]);
            }
        }

        return $attributes;
    }

    /**
     * Удалить несинхронизируемые аттрибуты из коллекции сущностей
     *
     * @param Collection $collection
     * @param SynchronizableModel $model
     * @return void
     */
    public function removeUnsyncAttributesFromCollection(Collection $collection, SynchronizableModel $model): Collection
    {
        return $collection->map(function ($attributes) use ($model) {
            return $this->removeUnsyncAttributes($attributes, $model);
        });
    }

    /**
     * Синхронизировать строку между локальной и глобальной моделью
     *
     * @param Model $localModel
     * @param Model $globalModel
     * @return void
     */
    public function syncModelRowById($id, Model $model, Model $localModel): void
    {
        $rowExist = $model->where($model->getKeyName(), '=', $id)->exists();
        $localRowExist = $localModel->where($localModel->getKeyName(), '=', $id)->exists();

        if ($rowExist && !$localRowExist) {
            $localModel->create([$localModel->getKeyName()=> $id]);
        } elseif (!$rowExist && $localRowExist) {
            $localModel->destroy($id);
        }
    }

    /**
     * Синхронизация всей локальной модели
     *
     * @param Model $model
     * @param Model $localModel
     * @return void
     */
    public function syncModels(Model $model, Model $localModel): void
    {
        $ids = $model->select($model->getKeyName())->get()->pluck($model->getKeyName());

        if ($ids->count() > 0) {
            $localIds = $localModel->select($localModel->getKeyName())->get()->pluck($localModel->getKeyName());
            $localKey = $localModel->getKeyName();

            $ids->diff($localIds)->each(function ($id) use ($localModel, $localKey) {
                $localModel->create([$localKey => $id]);
            });

            $localIds->diff($ids)->each(function ($id) use ($localModel) {
                $localModel->destroy($id);
            });
        }
    }
}
