<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;

use App\Services\User\UserHomePageService;
use Illuminate\Http\Request;

class UserHomePageBlogController extends Controller
{
  public function index()
  {
    $Testimonials = UserHomePageService::getAll();
    return  HttpResponseHelper::successResponse("successfully show Testimonial information", $Testimonials, 200);
  }

  // single Testimonial 
  public function show($id)
  {
    $Testimonial = UserHomePageService::show($id);
    return   HttpResponseHelper::successResponse("successfully fetch single Homepage Blog", $Testimonial, 200);
  }
}
