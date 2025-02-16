<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\ProjectRequest;
use App\Services\Admin\BlogService;
use App\Services\Admin\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $blogs =  ProjectService::getAll();
        return  HttpResponseHelper::successResponse("successfully show blog information", $blogs, 200);
    }
    //    store 
    public function store(ProjectRequest $request)
    {
        $blog = ProjectService::store($request);
        return   HttpResponseHelper::successResponse("Create blog successfully", $blog, 200);
    }
    // single Project
    public function show($id)
    {
        $blog = ProjectService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single blog", $blog, 200);
    }
    // update Project
    public function update(ProjectRequest $request, $id)
    {
        $blog = ProjectService::update($request, $id);
        return   HttpResponseHelper::successResponse("Update blog successfully", $blog, 200);
    }
    // delete Project
    public function destroy($id)
    {
        ProjectService::destroy($id);
        return   HttpResponseHelper::successResponse("Delete blog successfully", null, 200);
    }
}
