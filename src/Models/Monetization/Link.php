<?php

namespace MasterDmx\LaravelL2ppIntegration\Models\Monetization;

use Illuminate\Database\Eloquent\Builder;
use MasterDmx\LaravelL2ppIntegration\Collections\LinkCollection;
use MasterDmx\LaravelL2ppIntegration\Models\Monetization;

class Link extends Monetization
{
    protected $table = 'l2pp_monetizations';

    // ----------------------------------------------------
    // BASE
    // ----------------------------------------------------

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', Monetization::TYPE_LINK);
        });
    }

    public function newCollection(array $models = [])
    {
        return new LinkCollection($models);
    }
}
