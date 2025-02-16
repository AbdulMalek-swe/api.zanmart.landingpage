<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper; 
use App\Models\Company; 

class UserCompanyService
{

    /* get all company */
    public static function getAll()
    {
        try {
            return Company::latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single company 
    public static function show($id)
    {
        try {
            return Company::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
     
     
}
