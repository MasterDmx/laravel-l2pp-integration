<?php

namespace MasterDmx\LaravelL2ppIntegration\Repositories;

use Illuminate\Support\Collection;
use MasterDmx\LaravelL2ppIntegration\Components\Repository;

class CityRepository extends Repository
{
    /**
     * Получить все города
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function all(): Collection
    {
        return collect($this->integration->get('cities')->json());
    }

    /**
     * Найти по ID
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        return $this->integration->get('cities/' . $id)->json();
    }
}
