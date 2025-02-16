<?php
  
  namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\User\UserTestimonialService;
use Illuminate\Http\Request;

  class UserTestimonialController extends Controller{
    public function index(){
        $Testimonials = UserTestimonialService::getAll();
      return  HttpResponseHelper::successResponse("successfully show Testimonial information",$Testimonials,200);
    }
 
    // single Testimonial 
    public function show($id){ 
        $Testimonial = UserTestimonialService::show($id);
      return   HttpResponseHelper::successResponse("successfully fetch single Testimonial",$Testimonial,200);
    }
     
     
  }