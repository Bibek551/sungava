<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_date',
        'no_of_adults',
        'no_of_children',
        'full_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'comments',
        'total_price',
        'services',
        'package_id',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function getServicesAttribute($value)
    {
        return unserialize($value);
    }

    public function setServicesAttribute($value)
    {
        $this->attributes['services'] = serialize($value);
    }
}
