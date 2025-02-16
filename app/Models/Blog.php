<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
    protected $primaryKey = 'blog_id';
    protected $fillable = [
        'title',
        'content',
        'short_des',
        "slug",
        "category_id",
        'image'

    ];
    public function setTitleAttribute($value)
    {
        // Set the title with each word capitalized
        $this->attributes['title'] = ucwords($value);
        $slug = Str::slug($value, '-');
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        $finalSlug = $count ? "{$slug}-{$count}" : $slug;
        $this->attributes['slug'] = $finalSlug;
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            // Check if the image path exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Make sure to specify the foreign key
    }

}
