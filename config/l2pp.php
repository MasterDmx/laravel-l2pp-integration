<?php

return [
    // Current project options
    'project_id' => 1,
    'project_token' => '51f297902842915ae435d9b5e96b5574',

    // -----------------------------------------------------------
    // API
    // -----------------------------------------------------------

    // API
    'api_version' => 1,
    'api_url' => 'http://api.l2pp.ru',

    'url' => 'https://l2pp.ru',

    // -----------------------------------------------------------
    // Модуль: Media
    // -----------------------------------------------------------

    // Класс менеджер
    'media_manager' => \MasterDmx\LaravelMedia\MediaManager::class,

    // Обработчики
    'media_entity_l2pp_image' => \MasterDmx\LaravelL2ppIntegration\Components\Media\Image::class,

    // -----------------------------------------------------------
    // Модуль: Extra Attributes
    // -----------------------------------------------------------

    // Класс менеджер
    'attributes_manager' => \MasterDmx\LaravelExtraAttributes\ExtraAttributesManager::class,

    // Контексты
    'attributes_context_organization'       => \MasterDmx\LaravelL2ppIntegration\Components\ExtraAttributes\Contexts\OrganizationContext::class,
    'attributes_context_product'            => \MasterDmx\LaravelL2ppIntegration\Components\ExtraAttributes\Contexts\ProductContext::class,
    'attributes_context_product_category'   => \MasterDmx\LaravelL2ppIntegration\Components\ExtraAttributes\Contexts\CategoryContext::class,
    'attributes_context_monetization'       => \MasterDmx\LaravelL2ppIntegration\Components\ExtraAttributes\Contexts\MonetizationContext::class,

    // Сущности
    'attributes_entity_interval'             => \MasterDmx\ExtraAttributesPack\IntervalAttribute::class,
    'attributes_entity_list'                 => \MasterDmx\ExtraAttributesPack\ListAttribute::class,
    'attributes_entity_string'               => \MasterDmx\ExtraAttributesPack\StringAttribute::class,
    'attributes_entity_string_list'          => \MasterDmx\ExtraAttributesPack\StringListAttribute::class,
    'attributes_entity_dynamic_interval'     => \MasterDmx\ExtraAttributesPack\DynamicIntervalAttribute::class,
    'attributes_entity_geo'                  => \MasterDmx\ExtraAttributesPack\GeoAttribute::class,
    'attributes_entity_phones'               => \MasterDmx\ExtraAttributesPack\PhonesAttribute::class,
    'attributes_entity_site'                 => \MasterDmx\ExtraAttributesPack\SiteAttribute::class,
    'attributes_entity_ext_dynamic_interval' => \MasterDmx\ExtraAttributesPack\DynamicIntervalAttribute::class,
    'attributes_entity_ext_interval'         => \MasterDmx\ExtraAttributesPack\IntervalAttribute::class,
    'attributes_entity_ext_list'             => \MasterDmx\ExtraAttributesPack\ListAttribute::class,

    // -----------------------------------------------------------
    // Система
    // -----------------------------------------------------------

    'config' => MasterDmx\LaravelL2ppIntegration\Config::class,
];
