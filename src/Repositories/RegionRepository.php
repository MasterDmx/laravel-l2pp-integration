<?php

namespace MasterDmx\L2ppIntegration\Repositories;

use Illuminate\Support\Collection;
use MasterDmx\L2ppIntegration\Core\Repository;

class RegionRepository extends Repository
{
    /**
     * Получить все регионы
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function all(): Collection
    {
        return collect($this->integration->get('regions')->json());
    }

    /**
     * Найти регион по ID
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        return $this->integration->get('regions/' . $id)->json();
    }
}
