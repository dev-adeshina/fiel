<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Admin\Services\SalesReportService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class SalesReportController extends Controller
{
    public function __invoke(SalesReportService $reports) : JsonResponse
    {

        return response()->json([

            'data' => $reports->sales(),
        ]);
    }
}
