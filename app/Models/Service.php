<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'short_description',
        'slug',

        'seo_title',
        'meta_description',
        'meta_keywords'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/service/' .  $value);
        }

        return NULL;
    }
}
