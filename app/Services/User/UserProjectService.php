<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper; 
use App\Models\Project;
 

class UserProjectService
{

    /* get all Project */
    public static function getAll()
    {
        try {
            return Project::latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
   
    //    show single Project 
    public static function show($id)
    {
        try {
         
            return Project::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    
     
}
