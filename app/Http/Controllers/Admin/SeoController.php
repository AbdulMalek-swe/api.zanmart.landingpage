<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HttpResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeoRequest;
use App\Services\Admin\SeoService;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(Request $request)
    {
        $seos = SeoService::getAll($request);
        return  HttpResponseHelper::successResponse("successfully show seo information", $seos, 200);
    }
    //    store  seo
    public function store(SeoRequest $request)
    {
        if ($request->type != 'landing' && $request->type!='blog') {
            return HttpResponseHelper::errorResponse(["Landing page SEO is not supported"],   400);
        }
        if($request->type=='blog' && ($request->blog_id == null || $request->page_name)  ){
            return HttpResponseHelper::errorResponse(["Must be needed blog id or avoid page name"],   400);

        }
        if($request->type=='landing' && ($request->page_name == null || $request->blog_id)  ){
            return HttpResponseHelper::errorResponse(["Must be needed page name id or avoid page blog id"],   400);

        }
        else{
            $seo = SeoService::store($request);
            return   HttpResponseHelper::successResponse("Create seo successfully", $seo, 200);
        }
      
    }
    // single Seo 
    public function show($id)
    {
        $seo = SeoService::show($id);
        return   HttpResponseHelper::successResponse("successfully fetch single seo", $seo, 200);
    }
    // update seo
    public function update(SeoRequest $request, $id)
    {
        $seo = SeoService::update($request, $id);
        return   HttpResponseHelper::successResponse("Update seo successfully", $seo, 200);
    }
    // delete seo
    public function destroy($id)
    {
        SeoService::destroy($id);
        return   HttpResponseHelper::successResponse("Delete seo successfully", null, 200);
    }
}
