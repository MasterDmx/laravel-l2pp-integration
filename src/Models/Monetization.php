<?php

namespace MasterDmx\LaravelL2ppIntegration\Models;

use Illuminate\Database\Eloquent\Model;
use MasterDmx\LaravelExtraAttributes\Casts\ExtraAttributesBundleCast;

class Monetization extends Model
{
    const TYPE_LINK = 'link';
    const PIVOT_PRODUCTS_TABLE = 'l2pp_monetizations_products_p';
    const PIVOT_PRODUCTS_KEY = 'monetization_id';

    protected $table = 'l2pp_monetizations';
    protected $casts = [
        'enable'            => 'boolean',
        'enable_from_pp'    => 'boolean',
        'epc'               => 'double',
        'extra_attributes'  => ExtraAttributesBundleCast::class . ':monetization',
    ];

    // ---------------------------------------------------------
    // SCOPES
    // ---------------------------------------------------------

    public function scopeIsActive($query)
    {
        return $query->where('enable', true)->where('enable_from_pp', true);
    }

    // -----------------------------------------------------
    // Relation
    // -----------------------------------------------------

    // public function products()
    // {
    //     return $this->belongsToMany('App\Models\Role', 'role_user');
    // }
}
