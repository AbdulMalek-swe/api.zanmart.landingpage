<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller; 
use App\Services\User\UserCategoryService;

class UserCategoryController extends Controller
{
    public function index()
    {
        $Categorys = UserCategoryService::getAll();
        return  HttpResponseHelper::successResponse("successfully show Category information", $Categorys, 200);
    }
    
    // single Category 
    public function show($id)
    {
        $Category = UserCategoryService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single Category", $Category, 200);
    }
    
     
}
