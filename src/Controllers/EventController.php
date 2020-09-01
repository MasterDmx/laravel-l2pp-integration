<?php

namespace MasterDmx\L2ppIntegration\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

class EventController extends Controller
{
    use DispatchesJobs;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
