<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File; 

class CompanyService
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
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/company';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store company */
    public static function storeDocument($request)
    {
        return ([
            'title' => $request->title, 
            'image' => $request->image ? self::ImageUpload($request->image) : '',
        ]);
    }
    // store company
    public static function store($request)
    {
        try {
            return  Company::create(BlogService::storeDocument($request));
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
    // update single company
    public static function update($request, $id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->update(BlogService::storeDocument($request));
            return $company;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single company
    public static function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);
            // $image_path = $company->image; 
            if (File::exists($company->image)) {
                File::delete($company->image);
            } 
            return   $company->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
