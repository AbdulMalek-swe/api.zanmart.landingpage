<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper;
use App\Helpers\ImageHelpers; 
use App\Models\Project;
use App\Traits\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectService
{

    /* get all Project */
    public static function getAll()
    {
        try {
            return Project::latest()->paginate(5);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file)
    {
        $storagePath = 'images/project';
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $image = ImageHelpers::resizeImage($file);
        $path = ImageHelpers::saveImage($image, $storagePath, $fileName);
        return $path;
    }
    /* store Project */
    public static function storeDocument($request)
    {
        return ([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'description' => $request->description,
            // 'short_des' => $request->short_des,
            // 'category_id' => $request->category_id,
            'thumbnail_image' => $request->thumbnail_image ? self::ImageUpload($request->thumbnail_image) : '',
        ]);
    }
    // store Project
    public static function store($request)
    {
      
        try {
            $project = ProjectService::storeDocument($request);
             // Check if gallery_image is an array or single file
             if ($request->hasFile('multiple_images')) {
                $projectImages = $request->file('multiple_images');
                if (!is_array($projectImages)) {
                    $projectImages = [$projectImages]; // If not, wrap it in an array
                }
                $uploadedImages = ImageHelpers::ImageUploadMultiple($projectImages, 'images/project');
                $project['multiple_images'] = json_encode($uploadedImages);
            }
            return  Project::create($project);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    //    show single Project 
    public static function show($id)
    {
        try {
         
            return Project::findOrFail($id);
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // update single Project
    public static function update($request, $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->update(ProjectService::storeDocument($request));
            return $project;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
    // delete single Project
    public static function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            // $image_path = $Project->image; 
            if (File::exists($project->image)) {
                File::delete($project->image);
            } 
            return   $project->delete();;
        } catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}
