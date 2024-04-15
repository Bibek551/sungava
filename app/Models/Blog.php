<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'short_description',
        'date',
        'slug',
        'blog_category_id',

        'seo_title',
        'meta_description',
        'meta_keywords',
        'seo_schema'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/blog/' .  $value);
        }
        return NULL;
    }
}
