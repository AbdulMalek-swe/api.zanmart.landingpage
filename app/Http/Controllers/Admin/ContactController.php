<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Admin\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $blogs = ContactService::getAll();
        return  HttpResponseHelper::successResponse("successfully show contact information", $blogs, 200);
    }
    //    store 
    public function store(Request $request)
    {
        $blog = ContactService::store($request);
        return   HttpResponseHelper::successResponse("Create contact list successfully", $blog, 200);
    }
    // single blog 
    public function show($id)
    {
        $blog = ContactService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single contact list", $blog, 200);
    }
    // update blog
    public function update(Request $request, $id)
    {
        $blog = ContactService::update($request, $id);
        return   HttpResponseHelper::successResponse("Update contact successfully", $blog, 200);
    }
    // delete blog
    public function destroy($id)
    {
        ContactService::destroy($id);
        return   HttpResponseHelper::successResponse("Delete contact successfully", null, 200);
    }
}
