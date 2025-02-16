<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'title',
        'short_des', 
        'description',
        'status',
        'thumbnail_image', 
        'multiple_images',  
        
    ];
}
