<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper; 
use App\Models\Testimonial; 

class UserTestimonialService
{

    /* get all Testimonial */
    public static function getAll()
    {
        try {
            return Testimonial::latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
     
    
    //    show single Testimonial 
    public static function show($id)
    {
        try {
            return Testimonial::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
 
    
}
