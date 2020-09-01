<?php

namespace MasterDmx\L2ppIntegration\Services;

use Illuminate\Support\Collection;
use MasterDmx\L2ppIntegration\Contracts\SynchronizableModel;
use MasterDmx\L2ppIntegration\Core\Model;

class SyncModelService
{
    public function checkAttributeForSync(string $attribute, SynchronizableModel $model)
    {
        return in_array($attribute, $model->getSyncAttributes());
    }

    public function removeUnsyncAttributes(array $attributes, SynchronizableModel $model)
    {
        foreach (array_keys($attributes) as $key) {
            if (!$this->checkAttributeForSync($key, $model)) {
                unset($attributes[$key]);
            }
        }

        return $attributes;
    }

    public function removeUnsyncAttributesFromCollection(Collection $collection, SynchronizableModel $model)
    {
        return $collection->map(function ($attributes) use ($model) {
            return $this->removeUnsyncAttributes($attributes, $model);
        });
    }
}
