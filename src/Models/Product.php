<?php

namespace MasterDmx\LaravelL2ppIntegration\Models;

use Illuminate\Database\Eloquent\Model;
use MasterDmx\LaravelL2ppIntegration\Collections\ProductCollection;
use MasterDmx\LaravelL2ppIntegration\Models\Monetization\Link;
use MasterDmx\LaravelExtraAttributes\Casts\ExtraAttributesCollectionCast;
use MasterDmx\LaravelMedia\Casts\MediaCast;
use Str;

class Product extends Model
{
    const EXTRA_ATTRIBUTES_CONTEXT = 'product';

    protected $table = 'l2pp_products';

    protected $fillable = [
        'organization_id',
        'service_id',
        'name',
        'slug',
        'priority',
        'extra_attributes',
        'media',
        'created_user_id',
        'updated_user_id',
    ];

    protected $attributes = [
        'priority' => 50,
        'extra_attributes' => '[]',
        'media' => '[]',
    ];

    protected $casts = [
        'media' => MediaCast::class,
        'extra_attributes' => ExtraAttributesCollectionCast::class . ':' . Product::EXTRA_ATTRIBUTES_CONTEXT,
    ];

    // ---------------------------------------------------------
    // Logic
    // ---------------------------------------------------------

    public function defineOffer(): self
    {
        $this->epc = 0;
        $this->offerId = null;

        if (isset($this->offers) && $this->offers->count() > 0) {
            $offer = $this->offers->getBest();
            $this->epc = $offer->epc;
            $this->offerId = $offer->id;
        }

        return $this;
    }

    // ---------------------------------------------------------
    // SCOPES
    // ---------------------------------------------------------

    public function scopeByService($query, $service)
    {
        return $query->where('service_id', $service);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->whereHas('categories', function ($q) use ($category) {
            return $q->where('id', $category);
        });
    }


    // -----------------------------------------------------------
    // Relations
    // -----------------------------------------------------------

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'l2pp_products_categories_p');
    }

    public function monetizations()
    {
        return $this->belongsToMany(Monetization::class, Monetization::PIVOT_PRODUCTS_TABLE);
    }

    public function links()
    {
        return $this->belongsToMany(Link::class, Link::PIVOT_PRODUCTS_TABLE, null, Link::PIVOT_PRODUCTS_KEY);
    }

    // -----------------------------------------------------------
    // Base
    // -----------------------------------------------------------

    public function newCollection(array $models = [])
    {
        return new ProductCollection($models);
    }
}
