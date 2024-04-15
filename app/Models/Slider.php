<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'order',
        'link',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/slider/' .  $value);
        }
        return NULL;
    }
}
