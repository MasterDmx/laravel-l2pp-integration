<?php

namespace MasterDmx\LaravelL2ppIntegration\Components\ExtraAttributes\Contexts;

use MasterDmx\LaravelExtraAttributes\Entities\Context;
use MasterDmx\LaravelL2ppIntegration\Config;

class ProductContext extends Context
{
    /**
     * Конфиг
     *
     * @var \MasterDmx\LaravelL2ppIntegration\Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        parent::__construct();
    }

    protected function entities(): ?array
    {
        return $this->config->getAttributesEntities();
    }

    protected function attributes()
    {
        return data('test_products_fields');
    }
}
