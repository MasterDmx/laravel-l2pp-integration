<?php

namespace MasterDmx\LaravelL2ppIntegration\Contracts;

interface SynchronizableModel
{
    /**
     * Перечень синхронизируемых аттрибутов
     *
     * @var array
     */
    public function getSyncAttributes();
}
