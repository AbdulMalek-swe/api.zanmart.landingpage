<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller; 
use App\Services\User\UserProjectService; 

class UserProjectController extends Controller
{
    public function index()
    {
        $blogs =  UserProjectService::getAll();
        return  HttpResponseHelper::successResponse("successfully show blog information", $blogs, 200);
    }
    
    // single Project
    public function show($id)
    {
        $blog = UserProjectService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single blog", $blog, 200);
    }
   
     
}
