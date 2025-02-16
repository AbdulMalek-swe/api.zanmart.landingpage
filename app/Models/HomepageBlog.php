<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageBlog extends Model
{
    use HasFactory;
    // protected $primaryKey = 'contact_id';
    protected $fillable = [
        'blog_id',
        
        
    ];
    public function blog()
    {
        return $this->belongsTo(Blog::class,'blog_id', 'blog_id');
    }
    
}
