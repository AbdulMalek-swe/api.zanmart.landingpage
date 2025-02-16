<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper;
use App\Models\Blog;

class UserBlogService
{

    /* get all blog */
    public static function getAll()
    {
        try {
            return Blog::where('status' ,1)->latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single blog 
    public static function show($id)
    {
        try {
         
            return Blog::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
   
   
}
