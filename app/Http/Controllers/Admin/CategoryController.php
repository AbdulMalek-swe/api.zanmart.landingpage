<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    public function index()
    {
        $Categorys = CategoryService::getAll();
        return  HttpResponseHelper::successResponse("successfully show Category information", $Categorys, 200);
    }
    //    store 
    public function store(CategoryRequest $request)
    {
        $Category = CategoryService::store($request);
        return   HttpResponseHelper::successResponse("Create Category successfully", $Category, 200);
    }
    // single Category 
    public function show($id)
    {
        $Category = CategoryService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single Category", $Category, 200);
    }
    // update Category
    public function update(CategoryRequest $request, $id)
    {
        $Category = CategoryService::update($request, $id);
        return   HttpResponseHelper::successResponse("Update Category successfully", $Category, 200);
    }
    // delete Category
    public function destroy($id)
    {
        CategoryService::destroy($id);
        return   HttpResponseHelper::successResponse("Delete Category successfully", null, 200);
    }
}
