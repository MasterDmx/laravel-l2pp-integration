<?php

namespace MasterDmx\L2ppIntegration\Controllers;

use Illuminate\Routing\Controller;
use MasterDmx\L2ppIntegration\Repositories\CityRepository;
use MasterDmx\L2ppIntegration\UseCases\CityUseCase;

class TestController extends Controller
{

    public function init(string $method)
    {
        return $this->$method();
    }

    public function syncCity()
    {
        /**
         * @var \MasterDmx\L2ppIntegration\UseCases\CityUseCase
         */
        $case = app(CityUseCase::class);

        $case->destroy(1);


        // $repo = app(CityRepository::class)->find(1);

        // debug_print($repo);

        return 'Привет';
    }

}
