<?php

namespace MasterDmx\LaravelL2ppIntegration\Collections;

use MasterDmx\LaravelL2ppIntegration\Components\EloquentCollection;

/**
 * Коллекция организаций
 * @version 1.0.1 2020-11-22
 */
class OrganizationCollection extends EloquentCollection
{
    /**
     * Отсортировать коллекцию по приоритету и EPC
     *
     * @return self
     */
    public function sortByBenefit(): self
    {
        return $this->sortByDesc(function ($item) {
            return [$item->with_offers ?? false, $item->priority ?? 50, $item->epc ?? 0];
        });
    }

    public function filterByExtraAttributes($attributes, ?bool $strictly = null, bool $reverse = false)
    {
        return new static($this->filter(function ($organization) use ($attributes, $strictly, $reverse) {
            if (!isset($organization->products)) {
                return true;
            }

            $organization->products = $organization->products->filterByExtraAttributes($attributes, $strictly, $reverse);

            return isset($organization->products) && $organization->products->count() > 0;
        }));
    }

    /**
     * Фильтровать по аттрибутам предложений
     *
     * @param [type] $attributes
     * @param boolean|null $strictly
     * @param boolean $reverse
     * @return void
     */
    public function filterByProductsAttributes($attributes, ?bool $strictly = null, bool $reverse = false)
    {
        return new static($this->filter(function ($organization) use ($attributes, $strictly, $reverse) {
            if (!isset($organization->products)) {
                return true;
            }

            $organization->products = $organization->products->filterByExtraAttributes($attributes, $strictly, $reverse);

            return isset($organization->products) && $organization->products->count() > 0;
        }));
    }
}
