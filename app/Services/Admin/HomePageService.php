<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers;
use App\Models\HomepageBlog;
 
 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomePageService
{

    /* get all HomepageBlog */
    public static function getAll()
    {
        try {
            $homePageCategories = HomepageBlog::with('blog:blog_id,title,short_des,content,image') // Load the category relationship
            ->get()
            ->map(function ($blogItem) {
                return [
                    'blog_id' => $blogItem->blog->blog_id,
                    'title' => $blogItem->blog->title,
                    'short_des' => $blogItem->blog->short_des,
                    'image' =>  $blogItem->blog->image,
                    'content' => $blogItem->blog->content,
                      
                ];
            });
        return $homePageCategories;
            return HomepageBlog::latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
//    store  Home blog id  */
    public static function storeDocument($request)
    {
        return ([
            'blog_id' => $request->blog_id, 
        ]);
    }
    // store HomepageBlog
    public static function store($request)
    {
        try {
            return  HomepageBlog::create(HomePageService::storeDocument($request));
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single HomepageBlog 
    public static function show($id)
    {
        try {
            return HomepageBlog::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update single HomepageBlog
    public static function update($request, $id)
    {
        try {
            $HomepageBlog = HomepageBlog::findOrFail($id);
            $HomepageBlog->update(HomePageService::storeDocument($request));
            return $HomepageBlog;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single HomepageBlog
    public static function destroy($id)
    {
        try {
            $HomepageBlog = HomepageBlog::findOrFail($id);
            // $image_path = $HomepageBlog->image; 
            if (File::exists($HomepageBlog->image)) {
                File::delete($HomepageBlog->image);
            } 
            return   $HomepageBlog->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
