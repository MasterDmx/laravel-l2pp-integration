<?php

namespace MasterDmx\LaravelL2ppIntegration\Services;

use MasterDmx\LaravelL2ppIntegration\Models\Organization;
use MasterDmx\LaravelL2ppIntegration\Models\Service;

/**
 * Загрузчик предложений
 *
 * @version 1.0.0 2020-11-22
 */
class ProductsLoader
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
        $with['products.links'] = function ($q) {
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

    /**
     * Получить коллекцию предложений в рамках объекта организаци
     */
    public function getByOrganizations()
    {
        $query = $this->organizationModel()->with($this->getRelationships())->hasProducts(function ($q) {
            if (isset($this->options['service'])) {
                $q->byService($this->options['service']);
            }

            if (isset($this->options['category'])) {
                $q->byCategory($this->options['category']);
            }

            return $q;
        });

        $collection = $query->get()->each(function ($item) {
            $item->products = $item->products->defineOffers()->sortByBenefit();
            $item->defineEpc();
            $item->defineOffersFlag();
        });

        return $this->collection = $collection->sortByBenefit();
    }

    // -----------------------------------------------------------
    // System
    // -----------------------------------------------------------

    /**
     * Модель организаций
     */
    protected function organizationModel()
    {
        return app(Organization::class);
    }

    /**
     * Модель организаций
     */
    protected function serviceModel()
    {
        return app(Service::class);
    }

    protected function getRelationships(): array
    {
        return [
            'products' => function ($q) {
                if (isset($this->options['service'])) {
                    $q->byService($this->options['service']);
                }

                if (isset($this->options['category'])) {
                    $q->byCategory($this->options['category']);
                }

                return $q;
            },
            'products.service:id,name',
            'products.links' => function ($q) {
                return $q->isActive();
            },
        ];
    }

    // -----------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------

    private function getOptionsWithPrefix (): array
    {
        foreach ($this->options as $key => $value) {
            $res['_' . $key] = $value;
        }

        return $res ?? [];
    }
}
