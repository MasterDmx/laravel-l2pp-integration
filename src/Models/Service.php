<?php

namespace MasterDmx\LaravelL2ppIntegration\Models;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Builder;
use MasterDmx\LaravelL2ppIntegration\Traits\SluggableScope;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Service extends Model
{
    use SluggableScope;

    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'l2pp_services';

    // -----------------------------------------------------------
    // Scopes
    // -----------------------------------------------------------

    /**
     * Включая кол-во предложений
     *
     * @param [type] $q
     * @param integer $organization
     * @return void
     */
    public function scopeWithProductsCountByOrganization($q, int $organization)
    {
        return $q->withCount(['products' => function ($q) use ($organization) {
            return $q->where('organization_id', $organization);
        }]);
    }

    /**
     * Имея предложения определенной организации
     *
     * @param [type] $q
     * @param integer $organization
     * @return void
     */
    public function scopeHaveProductsByOrganization($q, int $organization)
    {
        return $q->whereHas('products', function (Builder $q) use ($organization) {
            return $q->where('organization_id', $organization);
        });
    }

    // -----------------------------------------------------------
    // Relations
    // -----------------------------------------------------------

    // public function categories()
    // {
    //     return $this->hasMany(Category::class);
    // }
}
