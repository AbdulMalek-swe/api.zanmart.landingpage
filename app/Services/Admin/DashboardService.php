<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\FrequentlyAsked;
use App\Models\Project;
use App\Models\User;

class DashboardService
{

    /* get all blog */
    public static function getAll()
    {
        try {
            $data = [
                'User' => User::count(),
                'Blog' => Blog::count(),
                'Projects' => Project::count(),
                'FAQ' => FrequentlyAsked::count(),
                'Contact' => Contact::count(),
            ];
            return $data;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
