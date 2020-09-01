<?php

namespace MasterDmx\L2ppIntegration\Core;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use DispatchesJobs;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
