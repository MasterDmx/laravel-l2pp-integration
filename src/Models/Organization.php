<?php

namespace MasterDmx\LaravelL2ppIntegration\Models;

use App\Traits\SluggableScope;
use Illuminate\Database\Eloquent\Model;
use MasterDmx\LaravelL2ppIntegration\Collections\OrganizationCollection;
use MasterDmx\LaravelExtraAttributes\Casts\ExtraAttributesCollectionCast;
use MasterDmx\LaravelMedia\Casts\MediaCast;

class Organization extends Model
{
    use SluggableScope;

    const EXTRA_ATTRIBUTES_CONTEXT = 'organization';

    public $timestamps = false;

    protected $table = 'l2pp_organizations';
    protected $fillable = ['type_id', 'slug', 'name', 'name_genitive', 'name_prepositional', 'media', 'extra_attributes', 'priority'];
    protected $attributes = [
        'priority' => 5,
        'type_id' => 'other',
        'media' => '[]',
        'extra_attributes' => '[]',
        'slug' => '',
    ];

    protected $casts = [
        'media' => MediaCast::class,
        'extra_attributes' => ExtraAttributesCollectionCast::class . ':' . Organization::EXTRA_ATTRIBUTES_CONTEXT,
    ];

    // -----------------------------------------------------------
    // Logic
    // -----------------------------------------------------------

    public function defineEpc(): self
    {
        $this->epc = isset($this->products) ? $this->products->getFirstEpc() : 0;
        return $this;
    }

    public function defineOffersFlag(): self
    {
        $this->with_offers = isset($this->products) ? $this->products->checkOffers() : false;
        return $this;
    }

    // ---------------------------------------------------------
    // SCOPES
    // ---------------------------------------------------------

    public function scopeHasProducts($q, callable $callback = null)
    {
        return isset($callback) ? $q->whereHas('products', $callback) : $q->has('products');
    }

    // ---------------------------------------------------------
    // Relations
    // ---------------------------------------------------------

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Получить все статьи по заданной области.
     */
    public function services()
    {
        return $this->ToManyThrough(Service::class, Product::class);
    }

    // ----------------------------------------------------------
    // Base
    // ----------------------------------------------------------

    public function newCollection(array $models = [])
    {
        return new OrganizationCollection($models);
    }
}
