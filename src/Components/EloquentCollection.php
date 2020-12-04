<?php

namespace MasterDmx\LaravelL2ppIntegration\Components;

use Illuminate\Database\Eloquent\Collection;

class EloquentCollection extends Collection
{
    /**
     * Скопировать коллекцию в новый объект
     *
     * @return self
     */
    public function copy(): self
    {
        return new static($this);
    }
}
