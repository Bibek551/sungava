<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'banner_image',
        'order',
        'status',
        'description',
        'short_description',
        'parent_id',
        'is_shown_homepage',

        'seo_title',
        'meta_description',
        'meta_keywords'
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'destination_package', 'destination_id', 'package_id');
    }

    public function parent()
    {
        return $this->belongsTo(Destination::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Destination::class, 'parent_id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/destination/' .  $value);
        }

        return NULL;
    }

    public function getBannerImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/destination/' .  $value);
        }
        return NULL;
    }

    public function otherinfos()
    {
        return $this->hasMany(DestinationInformation::class, 'destination_id');
    }
}
