<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\Category; 
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;  

class CategoryService
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
   
    /* store Category */
    public static function storeDocument($request)
    {
        return ([
            'name' => $request->name, 
        ]);
    }
    // store Category
    public static function store($request)
    {
        try {
            return  Category::create(CategoryService::storeDocument($request));
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
    // update single Category
    public static function update($request, $id)
    {
        try {
            $Category = Category::findOrFail($id);
            $Category->update(CategoryService::storeDocument($request));
            return $Category;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single Category
    public static function destroy($id)
    {
        try {
            $Category = Category::findOrFail($id);
            // $image_path = $Category->image; 
            if (File::exists($Category->image)) {
                File::delete($Category->image);
            } 
            return   $Category->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
