<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $result = DashboardService::getAll();
        return  HttpResponseHelper::successResponse("successfully show contact information",   $result, 200);
    }
}
