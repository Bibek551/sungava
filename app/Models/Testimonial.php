<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'description',
        'position',
        'order',
        'rating'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/testimonial/' .  $value);
        }
        return NULL;
    }
}
