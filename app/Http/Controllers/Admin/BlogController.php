<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Services\Admin\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
  public function index()
  {
    $blogs = BlogService::getAll();
    return  HttpResponseHelper::successResponse("successfully show blog information", $blogs, 200);
  }
  //    store 
  public function store(BlogRequest $request)
  {
    $blog = BlogService::store($request);
    return   HttpResponseHelper::successResponse("Create blog successfully", $blog, 200);
  }
  // single blog 
  public function show($id)
  {
    $blog = BlogService::show($id);
    return   HttpResponseHelper::successResponse("successfully fetch single blog", $blog, 200);
  }
  // update blog
  public function update(BlogRequest $request, $id)
  {
    $blog = BlogService::update($request, $id);
    return   HttpResponseHelper::successResponse("Update blog successfully", $blog, 200);
  }
  // delete blog
  public function destroy($id)
  {
    BlogService::destroy($id);
    return   HttpResponseHelper::successResponse("Delete blog successfully", null, 200);
  }
}
