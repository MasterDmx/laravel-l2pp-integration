<?php

namespace MasterDmx\LaravelL2ppIntegration;

use Illuminate\Support\Str;

class Config
{

    // ------------------------------------------------------
    // Extra Attributes
    // ------------------------------------------------------

    /**
     * Получить сущности аттрибутов
     *
     * @return array
     */
    public function getAttributesEntities(): array
    {
        return $this->getConfigPropertiesByPrefix('attributes_entity');
    }

    /**
     * Получить контексты аттрибутов
     *
     * @return array
     */
    public function getAttributesContexts(): array
    {
        return $this->getConfigPropertiesByPrefix('attributes_context');
    }

    // ------------------------------------------------------
    // Media
    // ------------------------------------------------------

    /**
     * Получить сущности аттрибутов
     *
     * @return array
     */
    public function getMediaEntities(): array
    {
        return $this->getConfigPropertiesByPrefix('media_entity');
    }

    // ------------------------------------------------------
    // Помошниик
    // ------------------------------------------------------

    protected function getConfigPropertiesByPrefix(string $prefix): array
    {
        foreach (config('l2pp') as $key => $value) {
            if (Str::is($prefix . '*', $key)) {
                $result[Str::substr($key, strlen($prefix) + 1)] = $value;
            }
        }

        return $result ?? [];
    }
}
