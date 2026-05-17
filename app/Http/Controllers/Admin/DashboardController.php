<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Admin\Services\DashboardService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $dashboard) 
    {

        return response()->json([

            'data' => $dashboard->summary(),
        ]);
    }
}
