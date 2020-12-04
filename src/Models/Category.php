<?php

namespace MasterDmx\LaravelL2ppIntegration\Models;

use Illuminate\Database\Eloquent\Model;
use MasterDmx\LaravelL2ppIntegration\Traits\SluggableScope;
use MasterDmx\LaravelL2ppIntegration\Service;
use MasterDmx\LaravelL2ppIntegration\Models\Category\Group;
use MasterDmx\LaravelExtraAttributes\Casts\ExtraAttributesBundleCast;

class Category extends Model
{
    use SluggableScope;

    public $incrementing = false;

    protected $table = 'l2pp_categories';
    protected $guarded = [];
    protected $casts = [
        'dynamic'            => 'boolean',
        'dynamic_conditions' => ExtraAttributesBundleCast::class . ':product_category',
    ];

    // -----------------------------------------------------------
    // Scopes
    // -----------------------------------------------------------

    public function scopeByService($query, string $value)
    {
        return $query->where('service_id', $value);
    }

    // -----------------------------------------------------------
    // Relations
    // -----------------------------------------------------------

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Product::class, 'l2pp_products_categories_p');
    }
}
