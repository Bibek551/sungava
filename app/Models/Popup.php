<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'order',
        'status',
        'link',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/popup/' .  $value);
        }
        return NULL;
    }
}
