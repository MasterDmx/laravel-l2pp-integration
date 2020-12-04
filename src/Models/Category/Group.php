<?php

namespace MasterDmx\LaravelL2ppIntegration\Models\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $incrementing = false;

    protected $table = 'l2pp_categories_groups';

    // public function group()
    // {
    //     return $this->belongsTo(Group::class);
    // }

    // -----------------------------------------------------------
    // Scopes
    // -----------------------------------------------------------

    public function scopeWithCategoriesByService($query, string $service, $fields = [])
    {
        return $query->with(['categories' => function ($q) use ($service, $fields) {
            if (isset($fields)) {
                if (is_string($fields)) {
                    $fields = explode(',', $fields);
                }

                $q->select($fields);
            }

            return $q->byService($service);
        }]);
    }

    public function scopeHasCategoriesByService($query, string $service)
    {
        return $query->whereHas('categories', function ($q) use ($service) {
            return $q->byService($service);
        });
    }

    // -----------------------------------------------------------
    // Relations
    // -----------------------------------------------------------

    public function categories()
    {
        return $this->hasMany(Category::class, 'group_id');
    }
}
