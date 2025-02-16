<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper; 
use App\Models\FrequentlyAsked;
 
class FrequentlyAskedService
{

    /* get all company */
    public static function getAll()
    {
        try {
            return FrequentlyAsked::latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
    /* store company */
    public static function storeDocument($request)
    {
        return ([
            'question' => $request->question, 
            'answer' => $request->answer,
          
        ]);
    }
    // store company
    public static function store($request)
    {
        try {
            return  FrequentlyAsked::create(FrequentlyAskedService::storeDocument($request));
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single company 
    public static function show($id)
    {
        try {
            return FrequentlyAsked::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update single company
    public static function update($request, $id)
    {
        try {
            $company = FrequentlyAsked::findOrFail($id);
            $company->update(FrequentlyAskedService::storeDocument($request));
            return $company;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single company
    public static function destroy($id)
    {
        try {
            $company = FrequentlyAsked::findOrFail($id);
            
            return   $company->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
