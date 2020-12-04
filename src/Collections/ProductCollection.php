<?php

namespace MasterDmx\LaravelL2ppIntegration\Collections;

use MasterDmx\LaravelL2ppIntegration\Components\EloquentCollection;
use MasterDmx\LaravelL2ppIntegration\Models\Offer;

class ProductCollection extends EloquentCollection
{
    public function getFirstEpc()
    {
        return $this->first()->epc;
    }

    public function checkOffers(): bool
    {
        foreach ($this as $item) {
            if (isset($item->offerId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Задать офферы всем предложениям
     *
     * @return self
     */
    public function defineOffers(): self
    {
        return $this->map(function ($item) {
            return $item->defineOffer();
        });
    }

    /**
     * Отсортировать коллекцию по приоритету и EPC
     *
     * @return self
     */
    public function sortByBenefit(): self
    {
        return $this->sortByDesc(function ($item) {
            return [isset($item->offers), $item->priority, $item->epc];
        });
    }

    public function filterByExtraAttributes($attributes, ?bool $strictly = null, bool $reverse = false)
    {
        return new static($this->filter(function ($item) use ($attributes, $strictly, $reverse) {
            if (!isset($item->extra_attributes) || $item->extra_attributes->isEmpty()) {
                return true;
            }

            return $item->extra_attributes->compare($attributes, $strictly, $reverse);
        }));
    }
}
