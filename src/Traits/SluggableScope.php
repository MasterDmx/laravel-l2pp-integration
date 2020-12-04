<?php

namespace MasterDmx\LaravelL2ppIntegration\Traits;

trait SluggableScope
{
    public function scopeBySlug($query, string $value)
    {
        return $query->where('slug', $value);
    }
}
