<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'banner_image',
        'order',
        'rating',
        'status',
        'description',
        'short_description',
        'currency',
        'adult_price',
        'child_price',
        'fair_price',
        'duration',
        'package_category_id',
        'inclusion',
        'exclusion',

        'seo_title',
        'meta_description',
        'meta_keywords'
    ];

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_package', 'package_id', 'destination_id');
    }

    public function category()
    {
        return $this->belongsTo(PackageCategory::class, 'package_category_id', 'id');
    }

    public function galleries()
    {
        return $this->hasMany(GalleryPackage::class, 'package_id');
    }

    public function itenaries()
    {
        return $this->hasMany(ItenaryPackage::class, 'package_id');
    }

    public function services()
    {
        return $this->hasMany(PackageService::class, 'package_id');
    }

    public function otherinfos()
    {
        return $this->hasMany(PackageInformation::class, 'package_id');
    }

    public function activity()
    {
        return $this->hasOne(PackageActivity::class);
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/package/' .  $value);
        }
        return NULL;
    }
}
