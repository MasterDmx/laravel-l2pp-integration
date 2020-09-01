<?php

namespace MasterDmx\L2ppIntegration\Core;

use Http;
use Illuminate\Http\Client\Response;

class Integration
{
    private $id;
    private $token;
    private $url;
    private $version;

    public function __construct(string $url, int $version, string $id, string $token)
    {
        $this->url = $url;
        $this->version = $version;
        $this->id = $id;
        $this->token = $token;
    }

    public function toFormQueryUrl(string $query)
    {
        return $this->url . '/v' . $this->version . '/' . $query;
    }

    /**
     * @return \Illuminate\Http\Client\Response
     */
    public function get(string $query, array $data = []): Response
    {
        return Http::withHeaders($this->getHeaders())->get($this->toFormQueryUrl($query), $data);
    }

    /**
     * @return \Illuminate\Http\Client\Response
     */
    public function post(string $query, array $data = []): Response
    {
        return Http::withHeaders($this->getHeaders())->post($this->toFormQueryUrl($query), $data);
    }

    private function getHeaders()
    {
        return [
            'x-project-id' => $this->id,
            'x-project-token' => $this->token
        ];
    }
}
