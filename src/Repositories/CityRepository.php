<?php

namespace MasterDmx\L2ppIntegration\Repositories;

use Illuminate\Support\Collection;
use MasterDmx\L2ppIntegration\Core\Repository;

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
