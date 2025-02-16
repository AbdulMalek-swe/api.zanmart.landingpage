<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name',
    ];
    // Define a relationship with blog 
    public function blogs()
    {
        return $this->hasMany(Blog::class,'category_id'); // Make sure to specify the foreign key
    }
}
