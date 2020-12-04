<?php

namespace MasterDmx\LaravelL2ppIntegration\Components;

use Http;
use Illuminate\Http\Client\Response;

class Integration
{
    private $id;
    private $token;
    private $url;
    private $apiUrl;
    private $apiVersion;

    public function __construct(string $url, string $apiUrl, int $apiVersion, string $id, string $token)
    {
        $this->url = $url;
        $this->apiUrl = $apiUrl;
        $this->apiVersion = $apiVersion;
        $this->id = $id;
        $this->token = $token;
    }

    public function getApiUrlWithQuery(string $query)
    {
        return $this->apiUrl . '/v' . $this->apiVersion . '/' . $query;
    }

    /**
     * GET запрос по API
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function get(string $query, array $data = []): Response
    {
        return Http::withHeaders($this->getHeaders())->get($this->getApiUrlWithQuery($query), $data);
    }

    /**
     * POST запрос по API
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function post(string $query, array $data = []): Response
    {
        return Http::withHeaders($this->getHeaders())->post($this->getApiUrlWithQuery($query), $data);
    }

    /**
     * Запрос на получение Media файла
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function media(string $path): Response
    {
        return Http::withOptions(['verify' => false])->get($this->url . '/storage/media/' . $path);
    }

    private function getHeaders()
    {
        return [
            'x-project-id' => $this->id,
            'x-project-token' => $this->token
        ];
    }
}
