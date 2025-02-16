<?php

namespace App\Services\User;

use App\Helpers\HttpResponseHelper;
use App\Models\HomepageBlog;

class UserHomePageService
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


    //    show single HomepageBlog 
    public static function show($id)
    {
        try {
            return HomepageBlog::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
