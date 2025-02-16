<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper; 
use App\Models\Category;   

class UserCategoryService
{

    /* get all Category */
    public static function getAll()
    {
        try {
            return Category::latest()->paginate(30);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
   
    
    //    show single Category 
    public static function show($id)
    {
        try {
            $category = Category::with('blogs')->find($id);
            return $category;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
     
}
