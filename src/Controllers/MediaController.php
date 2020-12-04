<?php

namespace MasterDmx\LaravelL2ppIntegration\Controllers;

use Illuminate\Routing\Controller;
use MasterDmx\LaravelL2ppIntegration\Components\Integration;

class MediaController extends Controller
{
    public function index(string $path, Integration $integration)
    {
        $response = $integration->media($path);
        return response($response->body(), $response->status())->withHeaders($response->headers());
    }
}
