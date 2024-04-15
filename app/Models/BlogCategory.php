<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'order',
        'status',
        'description',
        'short_description',

        'seo_title',
        'meta_description',
        'meta_keywords'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/blogcategory/' .  $value);
        }
        return NULL;
    }
}
