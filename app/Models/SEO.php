<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    use HasFactory;
    protected $primaryKey = 'seo_id';
    protected $fillable = [
        'title',
        'description', 
        'og_title',
        'og_description',
        'og_image',
        'canonical_tags',
        'meta_robots',
        'blog_id',
        'page_name',
        'type'
    ];
}
