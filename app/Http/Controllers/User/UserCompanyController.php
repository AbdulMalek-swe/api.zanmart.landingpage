<?php
  
  namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\User\UserCompanyService;

use Illuminate\Http\Request;

  class UserCompanyController extends Controller{
    public function index(){
        $company = UserCompanyService::getAll();
      return  HttpResponseHelper::successResponse("successfully show company information",$company,200);
    }
 
    // single company 
    public function show($id){ 
        $company = UserCompanyService::show($id);
      return   HttpResponseHelper::successResponse("successfully fetch single company",$company,200);
    }
    
  }