<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function rel_to_cat(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
