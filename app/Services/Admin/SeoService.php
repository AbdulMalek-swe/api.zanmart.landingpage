<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers; 
use App\Models\SEO; 
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File; 

class SeoService
{
 
    public static function getAll($request)
    {
        try {
            if($request->page_name|| $request->blog_id) {
                $query = SEO::query();
                // return $query;
                if ($request->page_name) {
                    $query->where('page_name', $request->page_name);
                }
                if ($request->blog_id) {
                    $query->where('blog_id', $request->blog_id);
                }
                $seo = $query->first(); 
                return $seo;
            }
            return SEO::all();
           
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/seo';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store SEO */
    public static function storeDocument($request)
    {      
        // 'meta_robots',
        return ([
            'title' => $request->title,
            'description' => $request->description,
            'og_title' => $request->og_title,
            'og_description' => $request->og_description,
            'og_image' => $request->og_image? self::ImageUpload($request->og_image) : '',
            'canonical_tags' => $request->canonical_tags,
             'meta_robots' => $request->meta_robots,
             'type' => $request->type,
             'blog_id' => $request->blog_id,
             'page_name' => $request->page_name,
        ]);
    }
    // store SEO
    public static function store($request)
    {
        try {
            return  SEO::create(SeoService::storeDocument($request));
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single SEO 
    public static function show($id)
    {
        try {
         
            return SEO::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update single SEO
    public static function update($request, $id)
    {
        try {
            $blog = SEO::findOrFail($id);
            $blog->update(SeoService::storeDocument($request));
            return $blog;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single SEO
    public static function destroy($id)
    {
        try {
            $seo = SEO::findOrFail($id);
            if (File::exists($seo->og_image)) {
                File::delete($seo->og_image);
            } 
            return   $seo->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
