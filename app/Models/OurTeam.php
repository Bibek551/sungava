<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'position',
        'description',
        'slug',
        'order',
        'facebook_link',
        'instagram_link',
        'linkedin_link',
        'twitter_link'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/team/' .  $value);
        }
        return NULL;
    }
}
