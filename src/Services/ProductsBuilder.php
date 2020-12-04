<?php

namespace MasterDmx\LaravelL2ppIntegration\Services;

use App\Models\Organization;
use App\Models\Service;

class ProductsBuilder
{
    public $collection;

    /**
     * Параметры
     *
     * @var array
     */
    private $options = [];

    // -----------------------------------------------------------
    // Options
    // -----------------------------------------------------------

    public function service($service): self
    {
        $this->options['service'] = $service;
        return $this;
    }

    public function category($category): self
    {
        $this->options['category'] = $category;
        return $this;
    }

    public function organization($organization): self
    {
        $this->options['organization'] = $organization;
        return $this;
    }

    public function filters()
    {

    }

    // -----------------------------------------------------------
    // Base
    // -----------------------------------------------------------

    /**
     * Получить коллекцию предложений
     */
    public function get()
    {
        $_service = $_category = null;

        extract($this->getOptionsWithPrefix());

        $with['products'] = function ($q) use ($_service, $_category) {
            if (isset($_service)) {
                $q->byService($_service);
            }

            if (isset($_category)) {
                $q->byCategory($_category);
            }

            return $q;
        };
        $with[] = 'products.local';
        $with[] = 'products.service:id,name';
        $with['products.offers'] = function ($q) {
            return $q->isActive();
        };

        $query = Organization::with($with);
        $query->hasProducts(function ($q) use ($_service, $_category) {
            if (isset($_service)) {
                $q->byService($_service);
            }

            if (isset($_category)) {
                $q->byCategory($_category);
            }

            return $q;
        });

        $collection = $query->get();

        foreach ($collection as $item) {
            $item->products = $item->products->defineOffers()->sortByBenefit();
            $item->defineEpc();
            $item->defineOffersFlag();
        }

        return $this->collection = $collection->sortByBenefit();
    }

    public function getServicesWithCountByOrganization(int $id)
    {
        $_service = $_category = null;

        extract($this->getOptionsWithPrefix());

        $with['products'] = function ($q) use ($_service, $_category) {
            if (isset($_service)) {
                $q->byService($_service);
            }

            if (isset($_category)) {
                $q->byCategory($_category);
            }

            return $q;
        };
        $with[] = 'products.local';
        $with[] = 'products.service:id,name';
        $with['products.offers'] = function ($q) {
            return $q->isActive();
        };

        $query = Service::with($with);
        $query->hasProducts(function ($q) use ($_service, $_category) {
            if (isset($_service)) {
                $q->byService($_service);
            }

            if (isset($_category)) {
                $q->byCategory($_category);
            }

            return $q;
        });

        $collection = $query->get();

        foreach ($collection as $item) {
            $item->products = $item->products->defineOffers()->sortByBenefit();
            $item->defineEpc();
            $item->defineOffersFlag();
        }

        return $this->collection = $collection->sortByBenefit();

        $organization = Organization::with($with)->where('id', $id);
    }

    // -----------------------------------------------------------
    // Sys
    // -----------------------------------------------------------

    private function getOptionsWithPrefix () {
        foreach ($this->options as $key => $value) {
            $res['_' . $key] = $value;
        }

        return $res;
    }
}
