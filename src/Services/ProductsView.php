<?php

namespace MasterDmx\LaravelL2ppIntegration\Services;

class ProductsView
{
    /**
     * Данные
     */
    private $collection;

    /**
     * Параметры
     *
     * @var array
     */
    private $options = [];

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    // -----------------------------------------------------------
    // Options
    // -----------------------------------------------------------

    /**
     * Установить шаблоны по услугам
     *
     * @param array $templates массив шаблонов
     * @return self
     */
    public function templates(array $templates): self
    {
        $this->options['templates'] = $templates;
        return $this;
    }

    // -----------------------------------------------------------
    // Base
    // -----------------------------------------------------------

    /**
     * Установить шаблоны по услугам
     *
     * @param array $templates массив шаблонов
     */
    public function view()
    {
        $result = '';

        foreach ($this->collection as $organization) {
            $result .= view('site.card.products.credit.orgniization', ['organization' => $organization]);
        }

        return $result;
    }

    public function clear(): void
    {
        $this->options = [];
    }

}
