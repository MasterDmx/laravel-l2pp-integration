<?php

namespace MasterDmx\LaravelL2ppIntegration\Components\ExtraAttributes\Contexts;

use MasterDmx\LaravelExtraAttributes\Entities\Context;
use MasterDmx\LaravelL2ppIntegration\Config;

class CategoryContext extends Context
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
        $fields = [
            'amount',
            'term',

            'age',
            'citizenship',
            'reg',
            'work',

            'geo',
        ];

        foreach (data('test_products_fields') as $id => $attribute) {
            if (!in_array($id, $fields)) {
                continue;
            }

            if ($attribute['entity'] == 'ext_interval') {
                $attribute['entity'] = 'interval';
            }

            if ($attribute['entity'] == 'ext_list') {
                $attribute['entity'] = 'list';
            }

            if ($attribute['entity'] == 'ext_dynamic_interval') {
                $attribute['entity'] = 'dynamic_interval';
            }

            $attributes[$id] = $attribute;
        }

        return $attributes ?? [];
    }
}
