<?php

namespace MasterDmx\LaravelL2ppIntegration\Collections;

use MasterDmx\LaravelL2ppIntegration\Components\EloquentCollection;
use MasterDmx\LaravelL2ppIntegration\Models\Monetization\Link;

class LinkCollection extends EloquentCollection
{
    /**
     * Получить лучший оффер по параметрам приоритета и EPC
     *
     * @return \MasterDmx\LaravelL2ppIntegration\Models\Monetization\Link
     */
    public function getBest(): Link
    {
        return $this->count() > 1 ? $this->sortByPriotityAndEpc()->first() : $this->first();
    }

    /**
     * Отсортировать коллекцию по приоритету и EPC
     *
     * @return self
     */
    public function sortByPriotityAndEpc(): self
    {
        return new static($this->sortByDesc(function ($item) {
            return [$item->priority, $item->epc];
        }));
    }


}
