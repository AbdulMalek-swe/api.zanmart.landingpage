<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helpers\HttpResponseHelper;
use App\Services\Admin\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banner = BannerService::getAll($request);
        return  HttpResponseHelper::successResponse("successfully show Category information", $banner, 200);
    }
    //    store 
    public function store(Request $request)
    {
        $Category = BannerService::store($request);
        return   HttpResponseHelper::successResponse("Create Category successfully", $Category, 200);
    }
    // single Category 
    public function show($id)
    {
        $Category = BannerService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single Category", $Category, 200);
    }
    // update Category
    public function update(Request $request, $id)
    {
        $Category = BannerService::update($request, $id);
        return   HttpResponseHelper::successResponse("Update Category successfully", $Category, 200);
    }
    // delete Category
    public function destroy($id)
    {
        BannerService::destroy($id);
        return   HttpResponseHelper::successResponse("Delete Category successfully", null, 200);
    }
}
