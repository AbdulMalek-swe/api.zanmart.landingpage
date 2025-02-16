<?php
  
  namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\TestimonialService;
use Illuminate\Http\Request;

  class TestimonialController extends Controller{
    public function index(){
        $Testimonials = TestimonialService::getAll();
      return  HttpResponseHelper::successResponse("successfully show Testimonial information",$Testimonials,200);
    }
//    store 
    public function store(Request $request){
        $Testimonial = TestimonialService::store($request);
      return   HttpResponseHelper::successResponse("Create Testimonial successfully",$Testimonial,200);
    }
    // single Testimonial 
    public function show($id){ 
        $Testimonial = TestimonialService::show($id);
      return   HttpResponseHelper::successResponse("successfully fetch single Testimonial",$Testimonial,200);
    }
    // update Testimonial
    public function update(Request $request,$id){
        $Testimonial = TestimonialService::update($request,$id);
      return   HttpResponseHelper::successResponse("Update Testimonial successfully",$Testimonial,200);
    }
    // delete Testimonial
    public function destroy($id){
        TestimonialService::destroy($id);
      return   HttpResponseHelper::successResponse("Delete Testimonial successfully",null,200);
    }
  }