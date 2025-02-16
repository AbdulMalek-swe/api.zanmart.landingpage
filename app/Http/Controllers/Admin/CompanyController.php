<?php
  
  namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\CompanyService;

use Illuminate\Http\Request;

  class CompanyController extends Controller{
    public function index(){
        $company = CompanyService::getAll();
      return  HttpResponseHelper::successResponse("successfully show company information",$company,200);
    }
//    store 
    public function store(Request $request){
        $company = CompanyService::store($request);
      return   HttpResponseHelper::successResponse("Create company successfully",$company,200);
    }
    // single company 
    public function show($id){ 
        $company = CompanyService::show($id);
      return   HttpResponseHelper::successResponse("successfully fetch single company",$company,200);
    }
    // update company
    public function update(Request $request,$id){
        $company = CompanyService::update($request,$id);
      return   HttpResponseHelper::successResponse("Update company successfully",$company,200);
    }
    // delete company
    public function destroy($id){
        CompanyService::destroy($id);
      return   HttpResponseHelper::successResponse("Delete company successfully",null,200);
    }
  }