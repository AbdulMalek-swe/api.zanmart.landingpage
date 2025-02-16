<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\User\UserFrequentlyAskedService;
use Illuminate\Http\Request;

class UserFrequentlyAskedController extends Controller
{
    public function index()
    {
        $blogs = UserFrequentlyAskedService::getAll();
        return  HttpResponseHelper::successResponse("successfully show contact information", $blogs, 200);
    }
    
    // single blog 
    public function show($id)
    {
        $blog = UserFrequentlyAskedService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single contact list", $blog, 200);
    }
    
}
