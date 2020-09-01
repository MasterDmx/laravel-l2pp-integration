<?php

namespace MasterDmx\L2ppIntegration\Contracts;

interface SynchronizableModel
{
    /**
     * Перечень синхронизируемых аттрибутов
     *
     * @var array
     */
    public function getSyncAttributes();
}
