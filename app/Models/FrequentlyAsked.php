<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentlyAsked extends Model
{
    use HasFactory;
    protected $primaryKey = 'frequently_id';
    protected $fillable = [
        'question',
        'answer' ,
               
        // 'role'if
        // if(i)
        
    ];
}
