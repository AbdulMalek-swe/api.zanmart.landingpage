<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Blog;
use App\Traits\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogService
{

    /* get all blog */
    public static function getAll()
    {
        try {
            return Blog::latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/blog';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store blog */
    public static function storeDocument($request)
    {
        return ([
            'title' => $request->title,
            'content' => $request->content,
            'short_des' => $request->short_des,
            'category_id' => $request->category_id,
            'image' => $request->image ? self::ImageUpload($request->image) : '',
        ]);
    }
    // store blog
    public static function store($request)
    {
        try {
            return  Blog::create(BlogService::storeDocument($request));
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
    // update single blog
    public static function update($request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->update(BlogService::storeDocument($request));
            return $blog;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single blog
    public static function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            // $image_path = $blog->image; 
            if (File::exists($blog->image)) {
                File::delete($blog->image);
            } 
            return   $blog->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
