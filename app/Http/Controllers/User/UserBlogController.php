<?php
  
  namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\User\UserBlogService;

  class UserBlogController extends Controller{
    public function index(){
        $blogs = UserBlogService::getAll();
      return  HttpResponseHelper::successResponse("successfully show blog information",$blogs,200);
    }
 
    // single blog 
    public function show($id){ 
        $blog = UserBlogService::show($id);
      return   HttpResponseHelper::successResponse("successfully fetch single blog",$blog,200);
    }
     
    
  }