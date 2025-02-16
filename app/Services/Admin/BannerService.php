<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Banner;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class BannerService
{

    /* get all banner */
    public static function getAll($request)
    {
        try {
            if ($request->banner_name) {
                $query = Banner::query();
                // return $query;
                if ($request->banner_name) {
                    $query->where('banner_name', $request->banner_name);
                }
                $banner = $query->first();
                return $banner;
            }
            return Banner::all();
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/banner';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store banner */
    public static function storeDocument($request)
    {
        return ([
            'title' => $request->title,
            'banner_name' => $request->banner_name,
            'button_text' => $request->button_text,
            'content' => $request->content,
            'image' => $request->image ? self::ImageUpload($request->image) : '',
        ]);
    }
    // store banner
    public static function store($request)
    {
        try {
         
            return  Banner::create(BannerService::storeDocument($request));
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single banner 
    public static function show($id)
    {
        try {
            return Banner::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update single banner
    public static function update($request, $id)
    {
        try {
            $category = Banner::findOrFail($id);
            $categoryData = BannerService::storeDocument($request);
            if ($request->image) {
                 $categoryData['image'] = self::ImageUpload($request->image);
            }else{
                $categoryData['image'] = $category->image;
            }
            return $category->update($categoryData);
            
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single banner
    public static function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            // $image_path = $banner->image; 
            if (File::exists($banner->image)) {
                File::delete($banner->image);
            }
            return   $banner->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
