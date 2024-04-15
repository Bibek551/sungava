<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activities',
        'trip_grade',
        'trip_type',
        'trip_mode',
        'trip_duration',
        'accomodation',
        'best_season',
        'transportation',
        'group_size',
        'package_id',
    ];
}
