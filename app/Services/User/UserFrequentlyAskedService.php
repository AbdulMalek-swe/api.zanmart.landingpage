<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper; 
use App\Models\FrequentlyAsked;
 
class UserFrequentlyAskedService
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
    
    
    
    //    show single company 
    public static function show($id)
    {
        try {
            return FrequentlyAsked::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
     
    
}
