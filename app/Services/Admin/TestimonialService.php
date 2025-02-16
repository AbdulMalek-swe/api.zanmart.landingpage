<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Testimonial;
use App\Traits\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TestimonialService
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
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/Testimonial';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store Testimonial */
    public static function storeDocument($request)
    {
        return ([
            'name' => $request->name,
            'designation' => $request->designation,
            'address' => $request->address,
            'comment' => $request->comment, 
            'image' => $request->image ? self::ImageUpload($request->image) : '',
        ]);
    }
    // store Testimonial
    public static function store($request)
    {
        try {
            return  Testimonial::create(TestimonialService::storeDocument($request));
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
    // update single Testimonial
    public static function update($request, $id)
    {
        try {
            $Testimonial = Testimonial::findOrFail($id);
            $Testimonial->update(TestimonialService::storeDocument($request));
            return $Testimonial;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single Testimonial
    public static function destroy($id)
    {
        try {
            $Testimonial = Testimonial::findOrFail($id);
            // $image_path = $Testimonial->image; 
            if (File::exists($Testimonial->image)) {
                File::delete($Testimonial->image);
            } 
            return   $Testimonial->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
