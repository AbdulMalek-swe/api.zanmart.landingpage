<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\FrequentlyAskedService;
use Illuminate\Http\Request;

class FrequentlyAskedController extends Controller
{
    public function index()
    {
        $blogs = FrequentlyAskedService::getAll();
        return  HttpResponseHelper::successResponse("successfully show contact information", $blogs, 200);
    }
    //    store 
    public function store(Request $request)
    {
        $blog = FrequentlyAskedService::store($request);
        return   HttpResponseHelper::successResponse("Create contact list successfully", $blog, 200);
    }
    // single blog 
    public function show($id)
    {
        $blog = FrequentlyAskedService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single contact list", $blog, 200);
    }
    // update blog
    public function update(Request $request, $id)
    {
        $blog = FrequentlyAskedService::update($request, $id);
        return   HttpResponseHelper::successResponse("Update contact successfully", $blog, 200);
    }
    // delete blog
    public function destroy($id)
    {
        FrequentlyAskedService::destroy($id);
        return   HttpResponseHelper::successResponse("Delete contact successfully", null, 200);
    }
}
